<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TravelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TravelRequestController extends Controller
{
    public function __construct()
    {
        // Middleware is applied via routes
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = $user->isAdmin() 
            ? TravelRequest::query()
            : $user->travelRequests();

        $travelRequests = QueryBuilder::for($query)
            ->allowedFilters([
                'status',
                AllowedFilter::exact('destination'),
                AllowedFilter::scope('date_from', 'byDateRange'),
                AllowedFilter::scope('date_to', 'byDateRange'),
            ])
            ->with(['user', 'approver'])
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $travelRequests
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requester_name' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:departure_date',
            'notes' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:pending,approved,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        
        // Define o status baseado no tipo de usuário
        $status = TravelRequest::STATUS_PENDING; // Padrão para usuários comuns
        
        if ($user->isAdmin() && $request->has('status')) {
            $status = $request->status;
        }

        $travelRequest = $user->travelRequests()->create([
            'requester_name' => $request->requester_name,
            'destination' => $request->destination,
            'departure_date' => $request->departure_date,
            'return_date' => $request->return_date,
            'notes' => $request->notes,
            'status' => $status,
        ]);

        $travelRequest->load(['user', 'approver']);

        return response()->json([
            'success' => true,
            'message' => 'Solicitação de viagem criada com sucesso',
            'data' => $travelRequest
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        
        $query = $user->isAdmin() 
            ? TravelRequest::query()
            : $user->travelRequests();

        $travelRequest = $query->with(['user', 'approver'])->find($id);

        if (!$travelRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Solicitação não encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $travelRequest
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        
        $query = $user->isAdmin() 
            ? TravelRequest::query()
            : $user->travelRequests();

        $travelRequest = $query->find($id);

        if (!$travelRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Solicitação não encontrada'
            ], 404);
        }

        if ($travelRequest->status !== TravelRequest::STATUS_PENDING) {
            return response()->json([
                'success' => false,
                'message' => 'Não é possível editar uma solicitação que não está pendente'
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'requester_name' => 'sometimes|required|string|max:255',
            'destination' => 'sometimes|required|string|max:255',
            'departure_date' => 'sometimes|required|date|after:today',
            'return_date' => 'sometimes|required|date|after:departure_date',
            'notes' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:pending,approved,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        // Campos que podem ser atualizados
        $updateData = $request->only([
            'requester_name',
            'destination',
            'departure_date', 
            'return_date',
            'notes'
        ]);

        // Se for admin, permite alterar o status
        if ($user->isAdmin() && $request->has('status')) {
            $updateData['status'] = $request->status;
        }

        $travelRequest->update($updateData);

        $travelRequest->load(['user', 'approver']);

        return response()->json([
            'success' => true,
            'message' => 'Solicitação atualizada com sucesso',
            'data' => $travelRequest
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        
        $query = $user->isAdmin() 
            ? TravelRequest::query()
            : $user->travelRequests();

        $travelRequest = $query->find($id);

        if (!$travelRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Solicitação não encontrada'
            ], 404);
        }

        if (!$travelRequest->canBeCancelled()) {
            return response()->json([
                'success' => false,
                'message' => 'Não é possível excluir esta solicitação'
            ], 422);
        }

        $travelRequest->delete();

        return response()->json([
            'success' => true,
            'message' => 'Solicitação excluída com sucesso'
        ]);
    }

    /**
     * Update status of the specified resource.
     */
    public function updateStatus(Request $request, string $id)
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Acesso negado. Apenas administradores podem alterar status.'
            ], 403);
        }

        $travelRequest = TravelRequest::find($id);

        if (!$travelRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Solicitação não encontrada'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,approved,cancelled',
            'cancellation_reason' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        $newStatus = $request->status;
        $message = '';

        switch ($newStatus) {
            case 'approved':
                if (!$travelRequest->canBeApproved()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Esta solicitação não pode ser aprovada'
                    ], 422);
                }
                
                $travelRequest->approve($user);
                $message = 'Solicitação aprovada com sucesso';
                break;

            case 'cancelled':
                if (!$travelRequest->canBeCancelled()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Esta solicitação não pode ser cancelada'
                    ], 422);
                }
                
                $travelRequest->cancel($request->cancellation_reason);
                $message = 'Solicitação cancelada com sucesso';
                break;

            case 'pending':
                // Reverter para pendente (apenas se não estiver já pendente)
                if ($travelRequest->status === TravelRequest::STATUS_PENDING) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Esta solicitação já está pendente'
                    ], 422);
                }
                
                $travelRequest->update([
                    'status' => TravelRequest::STATUS_PENDING,
                    'approved_at' => null,
                    'cancelled_at' => null,
                    'approved_by' => null,
                    'cancellation_reason' => null,
                ]);
                $message = 'Solicitação revertida para pendente com sucesso';
                break;
        }

        $travelRequest->load(['user', 'approver']);

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $travelRequest
        ]);
    }
}
