/**
 * Reusable functions for making HTTP requests.
 */

const RestClient = {
    /**
     * Makes a GET request.
     * @param {string} url - The URL to send the request to.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    get: function(url, onSuccess, onError) {
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: onSuccess,
            error: onError
        });
    },

    /**
     * Makes a POST request.
     * @param {string} url - The URL to send the request to.
     * @param {object} data - The data to send in the request body.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    post: function(url, data, onSuccess, onError) {
        $.ajax({
            url: url,
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            dataType: 'json',
            success: onSuccess,
            error: onError
        });
    },

    /**
     * Makes a PUT request.
     * @param {string} url - The URL to send the request to.
     * @param {object} data - The data to send in the request body.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    put: function(url, data, onSuccess, onError) {
        $.ajax({
            url: url,
            method: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(data),
            dataType: 'json',
            success: onSuccess,
            error: onError
        });
    },

    /**
     * Makes a DELETE request.
     * @param {string} url - The URL to send the request to.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    delete: function(url, onSuccess, onError) {
        $.ajax({
            url: url,
            method: 'DELETE',
            dataType: 'json',
            success: onSuccess,
            error: onError
        });
    }
};