<?php
require_once 'BaseDao.php';

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct("Users", "user_id");
    }

    public function insertUser($user) {
        $stmt = $this->connection->prepare("INSERT INTO users (username, first_name, last_name, email, password, is_admin) VALUES (:username, :first_name, :last_name, :email, :password, :is_admin)");
        $stmt->bindParam(':username', $user['username']);
        $stmt->bindParam(':first_name', $user['first_name']);
        $stmt->bindParam(':last_name', $user['last_name']);
        $stmt->bindParam(':email', $user['email']);
        $stmt->bindParam(':password', $user['password']);
        $stmt->bindParam(':is_admin', $user['is_admin']);
        $stmt->execute();
    }

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE user_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE user_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function editUser($user) {
        $stmt = $this->connection->prepare("UPDATE users SET username = :username, first_name = :first_name, last_name = :last_name, email = :email, password = :password, is_admin = :is_admin WHERE user_id = :id");
        $stmt->bindParam(':username', $user['username']);
        $stmt->bindParam(':first_name', $user['first_name']);
        $stmt->bindParam(':last_name', $user['last_name']);
        $stmt->bindParam(':email', $user['email']);
        $stmt->bindParam(':password', $user['password']);
        $stmt->bindParam(':is_admin', $user['is_admin']);
        $stmt->bindParam(':id', $user['user_id']);
        $stmt->execute();
    }
}
?>