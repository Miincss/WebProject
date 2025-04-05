<?php
require_once 'BaseDao.php';

class ReviewDao extends BaseDao {
    public function __construct() {
        parent::__construct("Reviews", "review_id");
    }

    public function getByBookId($book_id) {
        $stmt = $this->connection->prepare("SELECT * FROM reviews WHERE book_id = :book_id");
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByReviewId($review_id) {
        $stmt = $this->connection->prepare("SELECT * FROM reviews WHERE review_id = :review_id");
        $stmt->bindParam(':review_id', $review_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function addReview($review){
        $stmt = $this->connection->prepare("INSERT INTO reviews (book_id, user_id, rating, comment) VALUES (:book_id, :user_id, :rating, :comment)");
        $stmt->bindParam(':book_id', $review['book_id']);
        $stmt->bindParam(':user_id', $review['user_id']);
        $stmt->bindParam(':rating', $review['rating']);
        $stmt->execute();
        
    }
    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM reviews WHERE review_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>