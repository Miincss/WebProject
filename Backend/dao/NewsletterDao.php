<?php
require_once 'BaseDao.php';

class NewsletterDao extends BaseDao {
    public function __construct() {
        parent::__construct("Newsletters", "subscription_id");
    }

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM Newsletters");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addNewsletter($newsletter) {
        $stmt = $this->connection->prepare("INSERT INTO Newsletters (user_id, email) VALUES (:user_id , :email)");
        $stmt->bindParam(':user_id', $newsletter['user_id']);
        $stmt->bindParam(':email', $newsletter['email']);
        $stmt->execute();
    }
}
?>