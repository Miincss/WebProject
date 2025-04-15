<?php
require_once __DIR__ . '/../dao/ContactDao.php';
require_once 'BaseService.php';

class ContactService extends BaseService {
    public function __construct() {
        parent::__construct(new ContactDao());
    }
    public function getMessageById($messageId) {
        if (!is_numeric($messageId) || $messageId <= 0) {
            throw new Exception("Invalid message ID");
        }
        try {
            $message = $this->dao->getById($messageId);
            if (!$message) {
                throw new Exception("Message not found");
            }
            return $message;
        } catch (Exception $e) {
            throw new Exception("Error retrieving message: " . $e->getMessage());
        }
    }
    public function getAllMessages() {
        try {
            return $this->dao->getAll();
        } catch (Exception $e) {
            throw new Exception("Error retrieving all messages: " . $e->getMessage());
        }
    }
    public function createMessage($messageData) {
        $this->validateMessageData($messageData);
        try {
            return $this->dao->createMessage($messageData);
        } catch (Exception $e) {
            throw new Exception("Error creating message: " . $e->getMessage());
        }
    }
    private function validateMessageData($messageData) {
        // Check required fields
        $requiredFields = ['user_id', 'name', 'email', 'message'];
        foreach ($requiredFields as $field) {
            if (empty($messageData[$field])) {
                throw new Exception("Missing required field: $field");
            }
        }

        // Validate email format
        if (!filter_var($messageData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // Validate user_id
        if (!is_numeric($messageData['user_id']) || $messageData['user_id'] <= 0) {
            throw new Exception("Invalid user ID");
        }

        // Validate field lengths
        if (strlen($messageData['name']) > 255) {
            throw new Exception("Name is too long (maximum 255 characters)");
        }

        if (strlen($messageData['email']) > 255) {
            throw new Exception("Email is too long (maximum 255 characters)");
        }

        if (isset($messageData['subject']) && strlen($messageData['subject']) > 255) {
            throw new Exception("Subject is too long (maximum 255 characters)");
        }

        if (strlen($messageData['message']) > 1000) {
            throw new Exception("Message is too long (maximum 1000 characters)");
        }
    }
}
?>