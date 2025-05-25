/**
 * Service for handling book-related AJAX requests.
 */

const BookService = {
    /**
     * Fetches all books from the backend.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    getAllBooks: function(onSuccess, onError) {
        RestClient.get('/WebProject/Backend/books', onSuccess, onError);
    },

    /**
     * Fetches a single book by its ID.
     * @param {number} bookId - The ID of the book to fetch.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    getBookById: function(bookId, onSuccess, onError) {
        RestClient.get('/WebProject/Backend/books/' + bookId, onSuccess, onError);
    },

    /**
     * Adds a new book.
     * @param {object} bookData - The data for the new book.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    addBook: function(bookData, onSuccess, onError) {
        RestClient.post('/WebProject/Backend/books', bookData, onSuccess, onError);
    },

    /**
     * Updates an existing book.
     * @param {number} bookId - The ID of the book to update.
     * @param {object} bookData - The updated data for the book.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    updateBook: function(bookId, bookData, onSuccess, onError) {
        RestClient.put('/WebProject/Backend/books/' + bookId, bookData, onSuccess, onError);
    },

    /**
     * Deletes a book by its ID.
     * @param {number} bookId - The ID of the book to delete.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    deleteBook: function(bookId, onSuccess, onError) {
        RestClient.delete('/WebProject/Backend/books/' + bookId, onSuccess, onError);
    },

    /**
     * Fetches the first three featured books from the backend.
     * @param {function} onSuccess - Callback function for successful response.
     * @param {function} onError - Callback function for error response.
     */
    getFeaturedBooks: function(onSuccess, onError) {
        RestClient.get('/WebProject/Backend/books/featured', onSuccess, onError);
    }
};