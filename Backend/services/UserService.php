<?php
require_once __DIR__ . '/../dao/UserDao.php';
require_once 'BaseService.php';
require_once 'Validator.php';

class UserService extends BaseService {
    public function __construct() {
        parent::__construct(new UserDao());
    }

    public function createUser($userData) {
        Validator::validateUserData($userData);
        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        
        try {
            return $this->dao->insertUser($userData);
        } catch (Exception $e) {
            throw new Exception("Error creating user: " . $e->getMessage());
        }
    } 

    public function getAllUsers() {
        try {
            return $this->dao->getAll();
        } catch (Exception $e) {
            throw new Exception("Error retrieving users: " . $e->getMessage());
        }
    }

    public function getUserById($userId) {
        Validator::validateId($userId, 'user');
        try {
            $user = $this->dao->getById($userId);
            if (!$user) {
                throw new Exception("User not found");
            }
            return $user;
        } catch (Exception $e) {
            throw new Exception("Error retrieving user: " . $e->getMessage());
        }
    }

    public function updateUser($userId, $userData) {
        Validator::validateId($userId, 'user');
        Validator::validateUserData($userData, true);
        
        if (isset($userData['password'])) {
            $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        }

        $userData['user_id'] = $userId;

        try {
            return $this->dao->editUser($userData);
        } catch (Exception $e) {
            throw new Exception("Error updating user: " . $e->getMessage());
        }
    }

    public function deleteUser($userId) {
        Validator::validateId($userId, 'user');
        try {
            return $this->dao->delete($userId);
        } catch (Exception $e) {
            throw new Exception("Error deleting user: " . $e->getMessage());
        }
    }
}
?>

