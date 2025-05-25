/**
 * Service for handling review-related AJAX requests.
 */

const ReviewService = {
    /**
     * Fetches reviews for a specific book from the backend.
     * @param {number} bookId - The ID of the book whose reviews to fetch.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    getReviewsByBookId: function(bookId, onSuccess, onError) {
        RestClient.get('/WebProject/Backend/books/' + bookId + '/reviews', onSuccess, onError);
    },

    /**
     * Deletes a review by its ID.
     * @param {number} reviewId - The ID of the review to delete.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    deleteReview: function(reviewId, onSuccess, onError) {
        RestClient.delete('/WebProject/Backend/reviews/' + reviewId, onSuccess, onError);
    },

    /**
     * Submits a new review for a book.
     * @param {number} bookId - The ID of the book the review is for.
     * @param {object} reviewData - The data for the new review (user_name, rating, comment).
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    submitReview: function(bookId, reviewData, onSuccess, onError) {
        RestClient.post('/WebProject/Backend/books/' + bookId + '/reviews', reviewData, onSuccess, onError);
    }
};