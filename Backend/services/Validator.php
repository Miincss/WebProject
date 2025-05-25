<?php

class Validator {
    public static function validateId($id, $entityName = 'record') {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid {$entityName} ID");
        }
    }

    public static function validateRequiredFields($data, $requiredFields, $entityName = '') {
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $fieldName = str_replace('_', ' ', $field);
                throw new Exception("Missing required field: {$fieldName}");
            }
        }
    }

    public static function validateStringLength($value, $field, $maxLength) {
        if (strlen($value) > $maxLength) {
            $fieldName = str_replace('_', ' ', $field);
            throw new Exception("{$fieldName} is too long (maximum {$maxLength} characters)");
        }
    }

    public static function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
    }

    public static function validatePassword($password, $minLength = 8) {
        if (strlen($password) < $minLength) {
            throw new Exception("Password must be at least {$minLength} characters long");
        }
    }

    public static function validateBookData($data, $isUpdate = false) {
        if (!$isUpdate) {
            self::validateRequiredFields($data, ['title', 'author', 'genre', 'description'], 'book');
        }

        if (isset($data['title'])) {
            self::validateStringLength($data['title'], 'title', 255);
        }
        if (isset($data['author'])) {
            self::validateStringLength($data['author'], 'author', 255);
        }
        if (isset($data['genre'])) {
            self::validateStringLength($data['genre'], 'genre', 100);
        }
    }

    public static function validateUserData($data, $isUpdate = false) {
        if (!$isUpdate) {
            self::validateRequiredFields($data, ['username', 'first_name', 'last_name', 'email', 'password'], 'user');
        }

        if (isset($data['email'])) {
            self::validateEmail($data['email']);
        }
        if (isset($data['password'])) {
            self::validatePassword($data['password']);
        }
        if (isset($data['is_admin'])) {
            if (!is_numeric($data['is_admin'])) {
                throw new Exception("Invalid admin status value");
            }
        }
    }
}