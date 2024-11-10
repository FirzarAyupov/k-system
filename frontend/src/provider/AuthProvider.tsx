// Code for Token Validity and Expiration Strategy
import axios from 'axios';
import {createContext, ReactNode, useContext, useEffect, useMemo, useState} from 'react';

const AuthContext = createContext<{ token: string | null, setToken: (newToken: string) => void }>({
    token: null,
    setToken: () => {
    }
});

// Function to check if JWT is expired
const checkTokenValidity = (token: string) => {
    if (!token) return false; // Token doesn't exist

    const decodedToken = JSON.parse(atob(token.split('.')[1]));
    const expirationTime = decodedToken.exp * 1000; // Convert to milliseconds

    return Date.now() < expirationTime; // Check if token is not expired
};

// Function to handle expired tokens
const handleExpiredToken = () => {
    delete axios.defaults.headers.common['Authorization'];
    localStorage.removeItem('token');
    // Redirect to login page or handle expired token
};

const AuthProvider = ({children}: { children: ReactNode }) => {
    // State to hold the authentication token
    const [token, setToken_] = useState(localStorage.getItem('token'));

    // Function to set the authentication token
    const setToken = (newToken: string) => {
        setToken_(newToken);
    };

    // useEffect hook to handle token expiration and validity checks
    useEffect(() => {
        // Check if token exists and is valid
        if (token && checkTokenValidity(token)) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
            localStorage.setItem('token', token);

            // Calculate the time until token expiration
            const expirationTime = JSON.parse(atob(token.split('.')[1])).exp * 1000; // Convert to milliseconds
            const timeUntilExpiration = expirationTime - Date.now();

            // Set a timeout to automatically log out the user when the token expires
            setTimeout(() => {
                handleExpiredToken();
            }, timeUntilExpiration);
        } else {
            // Token is invalid or expired, handle accordingly
            handleExpiredToken();
        }
    }, [token]);

    // Memoized value of the authentication context
    const contextValue = useMemo(
        () => ({
            token,
            setToken,
        }),
        [token]
    );

    // Provide the authentication context to the children components
    return <AuthContext.Provider value={contextValue}>{children}</AuthContext.Provider>;
};

export const useAuth = () => {
    return useContext(AuthContext);
};

export default AuthProvider;