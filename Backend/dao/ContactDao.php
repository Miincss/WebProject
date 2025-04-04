<?php
require_once 'BaseDao.php';

class ContactDao extends BaseDao {
    public function __construct() {
        parent::__construct("Contact_Us", "message_id");
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM contact_us WHERE message_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM contact_us");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createMessage($message) {
        $stmt = $this->connection->prepare("INSERT INTO contact_us (user_id, name, email, subject, message) VALUES (:user_id, :name, :email, :subject, :message)");
        $stmt -> bindParam(':user_id', $message['user_id']);
        $stmt -> bindParam(':name', $message['name']);
        $stmt -> bindParam(':email', $message['email']);
        $stmt -> bindParam(':message', $message['message']);
        $stmt->execute();
    }

}
?>