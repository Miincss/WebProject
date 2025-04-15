<?php
require_once __DIR__ . '/../dao/UserDao.php';
require_once 'BaseService.php';

class UserService extends BaseService {
    public function __construct() {
        parent::__construct(new UserDao());
    }

    public function createUser($userData) {
        $this->validateUserData($userData);

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
        if (!is_numeric($userId) || $userId <= 0) {
            throw new Exception("Invalid user ID");
        }
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
        if (!is_numeric($userId) || $userId <= 0) {
            throw new Exception("Invalid user ID");
        }

        $this->validateUserData($userData, true);
        
        if (isset($userData['password'])) {
            $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        }

        $userData['id'] = $userId;

        try {
            return $this->dao->editUser($userData);
        } catch (Exception $e) {
            throw new Exception("Error updating user: " . $e->getMessage());
        }
    }
    public function deleteUser($userId) {
        if (!is_numeric($userId) || $userId <= 0) {
            throw new Exception("Invalid user ID");
        }
        try {
            return $this->dao->delete($userId);
        } catch (Exception $e) {
            throw new Exception("Error deleting user: " . $e->getMessage());
        }
    }
    private function validateUserData($userData, $isUpdate = false) {
        if (!$isUpdate) {
            $requiredFields = ['username', 'first_name', 'last_name', 'email', 'password'];
            foreach ($requiredFields as $field) {
                if (empty($userData[$field])) {
                    throw new Exception("Missing required field: $field");
                }
            }
        }

        if (isset($userData['email']) && !filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        if (isset($userData['password']) && strlen($userData['password']) < 8) {
            throw new Exception("Password must be at least 8 characters long");
        }

        if (isset($userData['is_admin']) && !is_numeric($userData['is_admin'])) {
            throw new Exception("Invalid admin status value");
        }
    }
}
?>

