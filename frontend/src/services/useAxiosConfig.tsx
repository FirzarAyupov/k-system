import {useAuth} from "../provider/AuthProvider.tsx";

export const useAxiosConfig = () => {
    const { token } = useAuth();
    return {
        baseURL: 'http://localhost/api/v1',
        headers: {
            'Authorization': `Bearer ${token}`,
        },
    };
};