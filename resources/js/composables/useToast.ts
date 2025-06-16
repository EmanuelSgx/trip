import { ref } from 'vue';

export interface ToastAction {
    label: string;
    action: () => void | Promise<void>;
    type?: 'primary' | 'secondary' | 'success' | 'error';
}

export interface Toast {
    id: number;
    type: 'success' | 'error' | 'warning' | 'info';
    title: string;
    message?: string;
    duration?: number;
    autoClose?: boolean;
    actions?: ToastAction[];
}

const toasts = ref<Toast[]>([]);
let toastId = 0;

export const useToast = () => {
    const addToast = (toast: Omit<Toast, 'id'>) => {
        const newToast: Toast = {
            id: ++toastId,
            autoClose: true,
            duration: 5000,
            ...toast,
        };

        toasts.value.push(newToast);

        // Auto remove toast
        if (newToast.autoClose) {
            setTimeout(() => {
                removeToast(newToast.id);
            }, newToast.duration);
        }

        return newToast.id;
    };

    const removeToast = (id: number) => {
        const index = toasts.value.findIndex((toast) => toast.id === id);
        if (index > -1) {
            toasts.value.splice(index, 1);
        }
    };

    const success = (title: string, message?: string, options?: Partial<Toast>) => {
        return addToast({ type: 'success', title, message, ...options });
    };

    const error = (title: string, message?: string, options?: Partial<Toast>) => {
        return addToast({ type: 'error', title, message, ...options });
    };

    const warning = (title: string, message?: string, options?: Partial<Toast>) => {
        return addToast({ type: 'warning', title, message, ...options });
    };
    const info = (title: string, message?: string, options?: Partial<Toast>) => {
        return addToast({ type: 'info', title, message, ...options });
    };

    const actionToast = (title: string, message: string, actions: ToastAction[], options?: Partial<Toast>) => {
        return addToast({
            type: 'info',
            title,
            message,
            actions,
            autoClose: false, // Não fechar automaticamente quando há ações
            ...options,
        });
    };

    const statusChangeNotification = (requestId: number, requesterName: string, onStatusChange: (status: string) => void) => {
        const actions: ToastAction[] = [
            {
                label: 'Aprovar',
                type: 'success',
                action: () => onStatusChange('approved'),
            },
            {
                label: 'Cancelar',
                type: 'error',
                action: () => onStatusChange('cancelled'),
            },
        ];

        return actionToast('Nova Solicitação de Viagem', `Solicitação #${requestId} de ${requesterName} aguarda aprovação`, actions, {
            type: 'info',
        });
    };

    const clear = () => {
        toasts.value = [];
    };

    return {
        toasts: toasts,
        addToast,
        removeToast,
        success,
        error,
        warning,
        info,
        actionToast,
        statusChangeNotification,
        clear,
    };
};
