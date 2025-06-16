<?php

namespace Tests\Feature;

use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class TravelRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test users
        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'role' => User::ROLE_USER,
        ]);

        $this->admin = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'role' => User::ROLE_ADMIN,
        ]);
    }

    protected function getAuthHeaders($user = null)
    {
        $user = $user ?: $this->user;
        $token = JWTAuth::fromUser($user);
        return ['Authorization' => "Bearer {$token}"];
    }

    public function test_user_can_create_travel_request()
    {
        $data = [
            'requester_name' => $this->user->name,
            'destination' => 'São Paulo',
            'departure_date' => now()->addDays(5)->toDateString(),
            'return_date' => now()->addDays(10)->toDateString(),
            'notes' => 'Business meeting',
        ];

        $response = $this->postJson('/api/requests', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
                ->assertJson([
                    'success' => true,
                    'message' => 'Solicitação de viagem criada com sucesso',
                ]);

        $this->assertDatabaseHas('travel_requests', [
            'user_id' => $this->user->id,
            'destination' => 'São Paulo',
            'status' => TravelRequest::STATUS_PENDING,
        ]);
    }

    public function test_user_cannot_create_travel_request_with_invalid_dates()
    {
        $data = [
            'requester_name' => $this->user->name,
            'destination' => 'São Paulo',
            'departure_date' => now()->subDay()->toDateString(), // Past date
            'return_date' => now()->addDays(10)->toDateString(),
            'notes' => 'Business meeting',
        ];

        $response = $this->postJson('/api/requests', $data, $this->getAuthHeaders());

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['departure_date']);
    }

    public function test_user_can_view_own_travel_requests()
    {
        $request = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->getJson('/api/requests', $this->getAuthHeaders());

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                ])
                ->assertJsonFragment([
                    'id' => $request->id,
                    'destination' => $request->destination,
                ]);
    }

    public function test_user_cannot_view_other_users_travel_requests()
    {
        $otherUser = User::factory()->create(['role' => User::ROLE_USER]);
        $request = TravelRequest::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $response = $this->getJson('/api/requests', $this->getAuthHeaders());

        $response->assertStatus(200)
                ->assertJson(['success' => true])
                ->assertJsonMissing(['id' => $request->id]);
    }

    public function test_admin_can_view_all_travel_requests()
    {
        $userRequest = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->getJson('/api/requests', $this->getAuthHeaders($this->admin));

        $response->assertStatus(200)
                ->assertJson(['success' => true])
                ->assertJsonFragment([
                    'id' => $userRequest->id,
                ]);
    }

    public function test_admin_can_approve_travel_request()
    {
        $request = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => TravelRequest::STATUS_PENDING,
        ]);

        $response = $this->patchJson(
            "/api/requests/{$request->id}/status",
            ['status' => 'approved'],
            $this->getAuthHeaders($this->admin)
        );

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Solicitação aprovada com sucesso',
                ]);

        $this->assertDatabaseHas('travel_requests', [
            'id' => $request->id,
            'status' => TravelRequest::STATUS_APPROVED,
            'approved_by' => $this->admin->id,
        ]);
    }

    public function test_admin_can_cancel_travel_request()
    {
        $request = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => TravelRequest::STATUS_PENDING,
        ]);

        $response = $this->patchJson(
            "/api/requests/{$request->id}/status",
            [
                'status' => 'cancelled',
                'cancellation_reason' => 'Budget constraints',
            ],
            $this->getAuthHeaders($this->admin)
        );

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Solicitação cancelada com sucesso',
                ]);

        $this->assertDatabaseHas('travel_requests', [
            'id' => $request->id,
            'status' => TravelRequest::STATUS_CANCELLED,
            'cancellation_reason' => 'Budget constraints',
        ]);
    }

    public function test_user_cannot_approve_travel_request()
    {
        $request = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => TravelRequest::STATUS_PENDING,
        ]);

        $response = $this->patchJson(
            "/api/requests/{$request->id}/status",
            ['status' => 'approved'],
            $this->getAuthHeaders($this->user)
        );

        $response->assertStatus(403)
                ->assertJson([
                    'success' => false,
                    'message' => 'Acesso negado. Apenas administradores podem alterar status.',
                ]);
    }

    public function test_user_can_update_own_pending_request()
    {
        $request = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => TravelRequest::STATUS_PENDING,
            'destination' => 'Original Destination',
        ]);

        $updateData = [
            'destination' => 'Updated Destination',
            'notes' => 'Updated notes',
        ];

        $response = $this->putJson(
            "/api/requests/{$request->id}",
            $updateData,
            $this->getAuthHeaders($this->user)
        );

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Solicitação atualizada com sucesso',
                ]);

        $this->assertDatabaseHas('travel_requests', [
            'id' => $request->id,
            'destination' => 'Updated Destination',
            'notes' => 'Updated notes',
        ]);
    }

    public function test_user_cannot_update_approved_request()
    {
        $request = TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => TravelRequest::STATUS_APPROVED,
        ]);

        $updateData = [
            'destination' => 'Updated Destination',
        ];

        $response = $this->putJson(
            "/api/requests/{$request->id}",
            $updateData,
            $this->getAuthHeaders($this->user)
        );

        $response->assertStatus(422)
                ->assertJson([
                    'success' => false,
                    'message' => 'Não é possível editar uma solicitação que não está pendente',
                ]);
    }

    public function test_requires_authentication_to_access_api()
    {
        $response = $this->getJson('/api/requests');
        
        $response->assertStatus(401);
    }

    public function test_can_filter_requests_by_status()
    {
        TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => TravelRequest::STATUS_PENDING,
        ]);

        TravelRequest::factory()->create([
            'user_id' => $this->user->id,
            'status' => TravelRequest::STATUS_APPROVED,
        ]);

        $response = $this->getJson(
            '/api/requests?filter[status]=pending',
            $this->getAuthHeaders($this->user)
        );

        $response->assertStatus(200);
        $data = $response->json('data.data');
        
        $this->assertCount(1, $data);
        $this->assertEquals(TravelRequest::STATUS_PENDING, $data[0]['status']);
    }
}
