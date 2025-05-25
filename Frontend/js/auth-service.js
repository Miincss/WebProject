/**
 * Service for handling authentication-related AJAX requests.
 */

const AuthService = {
    /**
     * Sends a login request to the backend.
     * @param {object} credentials - User login credentials (e.g., { email, password }).
     * @param {function} onSuccess - Callback function for successful login.
     * @param {function} onError - Callback function for login error.
     */
    login: function(credentials, onSuccess, onError) {
        RestClient.post('/WebProject/Backend/auth/login', credentials, onSuccess, onError);
    },

    /**
     * Sends a registration request to the backend.
     * @param {object} userData - User registration data.
     * @param {function} onSuccess - Callback function for successful registration.
     * @param {function} onError - Callback function for registration error.
     */
    register: function(userData, onSuccess, onError) {
        RestClient.post('/WebProject/Backend/auth/register', userData, onSuccess, onError);
    },

    // Add other authentication-related functions as needed (e.g., logout, forgot password)
};