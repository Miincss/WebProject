<?php
require_once __DIR__ . '/../dao/ReviewDao.php';
require_once 'BaseService.php';

class ReviewService extends BaseService {
    public function __construct() {
        parent::__construct(new ReviewDao());
    }

    public function getByBookId($bookId) {
        if (!is_numeric($bookId) || $bookId <= 0) {
            throw new Exception("Invalid book ID");
        }
        try {
            return $this->dao->getByBookId($bookId);
        } catch (Exception $e) {
            throw new Exception("Error retrieving reviews for book: " . $e->getMessage());
        }
    }
    public function getByReviewId($reviewId) {
        if (!is_numeric($reviewId) || $reviewId <= 0) {
            throw new Exception("Invalid review ID");
        }
        try {
            $review = $this->dao->getByReviewId($reviewId);
            if (!$review) {
                throw new Exception("Review not found");
            }
            return $review;
        } catch (Exception $e) {
            throw new Exception("Error retrieving review: " . $e->getMessage());
        }
    }
    public function addReview($reviewData) {
        $this->validateReviewData($reviewData);
        try {
            return $this->dao->addReview($reviewData);
        } catch (Exception $e) {
            throw new Exception("Error adding review: " . $e->getMessage());
        }
    }

    public function deleteReview($reviewId) {
        if (!is_numeric($reviewId) || $reviewId <= 0) {
            throw new Exception("Invalid review ID");
        }
        try {
            return $this->dao->delete($reviewId);
        } catch (Exception $e) {
            throw new Exception("Error deleting review: " . $e->getMessage());
        }
    }
    private function validateReviewData($reviewData) {
        // Check required fields
        $requiredFields = ['book_id', 'user_id', 'rating'];
        foreach ($requiredFields as $field) {
            if (!isset($reviewData[$field]) || empty($reviewData[$field])) {
                throw new Exception("Missing required field: $field");
            }
        }

        // Validate IDs
        if (!is_numeric($reviewData['book_id']) || $reviewData['book_id'] <= 0) {
            throw new Exception("Invalid book ID");
        }

        if (!is_numeric($reviewData['user_id']) || $reviewData['user_id'] <= 0) {
            throw new Exception("Invalid user ID");
        }

        // Validate rating
        if (!is_numeric($reviewData['rating']) || $reviewData['rating'] < 1 || $reviewData['rating'] > 5) {
            throw new Exception("Rating must be between 1 and 5");
        }

        // Validate comment length if provided
        if (isset($reviewData['comment']) && strlen($reviewData['comment']) > 1000) {
            throw new Exception("Comment is too long (maximum 1000 characters)");
        }
    }
}
?>