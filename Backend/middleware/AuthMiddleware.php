<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {
    public function verifyToken($token){
        if(!$token)
            Flight::halt(401, "Missing authentication header");
        $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
        Flight::set('user', $decoded_token->user);
        Flight::set('jwt_token', $token);
        return TRUE;
    }

    public function isAdmin() {
        $user = Flight::get('user');
        return isset($user->is_admin) && $user->is_admin == 1;
    }

    public function requireAdmin() {
        if (!$this->isAdmin()) {
            Flight::halt(403, 'Access denied: Admin privileges required');
        }
    }

    public function requireSelfOrAdmin($userId) {
        $user = Flight::get('user');
        if (!$this->isAdmin() && $user->user_id != $userId) {
            Flight::halt(403, 'Access denied: Can only modify your own profile');
        }
    }
}