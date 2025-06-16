import axios from 'axios';
import { ref } from 'vue';

export function useTravelRequests() {
    const isLoading = ref(false);

    const getRequests = async (queryParams = '') => {
        isLoading.value = true;
        try {
            const response = await axios.get(`/api/requests?${queryParams}`);

            if (response.data.success) {
                return response.data.data;
            } else {
                throw new Error(response.data.message || 'Failed to fetch requests');
            }
        } catch (error: any) {
            console.error('Error fetching requests:', error);
            throw error;
        } finally {
            isLoading.value = false;
        }
    };

    const getRequest = async (id: number) => {
        isLoading.value = true;
        try {
            const response = await axios.get(`/api/requests/${id}`);

            if (response.data.success) {
                return response.data.data;
            } else {
                throw new Error(response.data.message || 'Failed to fetch request');
            }
        } catch (error: any) {
            console.error('Error fetching request:', error);
            throw error;
        } finally {
            isLoading.value = false;
        }
    };

    const createRequest = async (requestData: any) => {
        isLoading.value = true;
        try {
            const response = await axios.post('/api/requests', requestData);

            if (response.data.success) {
                return response.data.data;
            } else {
                throw new Error(response.data.message || 'Failed to create request');
            }
        } catch (error: any) {
            console.error('Error creating request:', error);
            throw error;
        } finally {
            isLoading.value = false;
        }
    };

    const updateRequest = async (id: number, requestData: any) => {
        isLoading.value = true;
        try {
            const response = await axios.put(`/api/requests/${id}`, requestData);

            if (response.data.success) {
                return response.data.data;
            } else {
                throw new Error(response.data.message || 'Failed to update request');
            }
        } catch (error: any) {
            console.error('Error updating request:', error);
            throw error;
        } finally {
            isLoading.value = false;
        }
    };

    const deleteRequest = async (id: number) => {
        isLoading.value = true;
        try {
            const response = await axios.delete(`/api/requests/${id}`);

            if (response.data.success) {
                return true;
            } else {
                throw new Error(response.data.message || 'Failed to delete request');
            }
        } catch (error: any) {
            console.error('Error deleting request:', error);
            throw error;
        } finally {
            isLoading.value = false;
        }
    };

    const updateStatus = async (id: number, statusData: any) => {
        isLoading.value = true;
        try {
            const response = await axios.patch(`/api/requests/${id}/status`, statusData);

            if (response.data.success) {
                return response.data.data;
            } else {
                throw new Error(response.data.message || 'Failed to update status');
            }
        } catch (error: any) {
            console.error('Error updating status:', error);
            throw error;
        } finally {
            isLoading.value = false;
        }
    };

    return {
        isLoading,
        getRequests,
        getRequest,
        createRequest,
        updateRequest,
        deleteRequest,
        updateStatus,
    };
}
