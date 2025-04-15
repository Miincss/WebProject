<?php
require_once __DIR__ . '/../dao/NewsletterDao.php';
require_once 'BaseService.php';

class NewsletterService extends BaseService {
    public function __construct() {
        parent::__construct(new NewsletterDao());
    }
    public function getAllSubscriptions() {
        try {
            return $this->dao->getAll();
        } catch (Exception $e) {
            throw new Exception("Error retrieving all subscriptions: " . $e->getMessage());
        }
    }
    public function addSubscription($subscriptionData) {
        $this->validateSubscriptionData($subscriptionData);
        try {
            return $this->dao->addNewsletter($subscriptionData);
        } catch (Exception $e) {
            throw new Exception("Error adding subscription: " . $e->getMessage());
        }
    }
    private function validateSubscriptionData($subscriptionData) {
        // Check required fields
        $requiredFields = ['user_id', 'email'];
        foreach ($requiredFields as $field) {
            if (empty($subscriptionData[$field])) {
                throw new Exception("Missing required field: $field");
            }
        }

        // Validate email format
        if (!filter_var($subscriptionData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // Validate user_id
        if (!is_numeric($subscriptionData['user_id']) || $subscriptionData['user_id'] <= 0) {
            throw new Exception("Invalid user ID");
        }

        // Validate field lengths
        if (strlen($subscriptionData['email']) > 255) {
            throw new Exception("Email is too long (maximum 255 characters)");
        }
    }
}
?>





