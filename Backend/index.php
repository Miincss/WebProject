<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Enable Flight debug mode
Flight::set('flight.log_errors', true);
Flight::set('flight.handle_errors', true);

// Include service files
require_once __DIR__ . '/services/AuthService.php';
require_once __DIR__ . '/services/BaseService.php';
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/BookService.php';
require_once __DIR__ . '/services/ReviewService.php';
require_once __DIR__ . '/services/ContactService.php';
require_once __DIR__ . '/services/NewsletterService.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';

// Register services with new instances
Flight::register('auth_service', 'AuthService', [], function($authService) {
    return new AuthService();
});
Flight::register('UserService', 'UserService', [], function($userService) {
    return new UserService();
});
Flight::register('BookService', 'BookService', [], function($bookService) {
    return new BookService();
});
Flight::register('ReviewService', 'ReviewService', [], function($reviewService) {
    return new ReviewService();
});
Flight::register('ContactService', 'ContactService', [], function($contactService) {
    return new ContactService();
});
Flight::register('NewsletterService', 'NewsletterService', [], function($newsletterService) {
    return new NewsletterService();
});
Flight::register('auth_middleware', 'AuthMiddleware', [], function($authMiddleware) {
    return new AuthMiddleware();
});

// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authentication");

// JWT Authentication middleware
Flight::route('/*', function() {
    if (
        strpos(Flight::request()->url, '/auth/login') === 0 ||
        strpos(Flight::request()->url, '/auth/register') === 0 ||
        strpos(Flight::request()->url, '/test') === 0
    ) {
        return TRUE;
    } else {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if (!$token) {
                Flight::halt(401, "Missing authentication header");
            }

            $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
            Flight::set('user', $decoded_token->user);
            Flight::set('jwt_token', $token);
            return TRUE;
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    }
});

// Include all route files
require_once __DIR__. '/routes/AuthRoutes.php';
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/BookRoutes.php';
require_once __DIR__ . '/routes/ReviewRoutes.php';
require_once __DIR__ . '/routes/ContactRoutes.php';
require_once __DIR__ . '/routes/NewsletterRoutes.php';

// Include Swagger documentation
require_once __DIR__ . '/swagger.php';

// Add this before Flight::start();
Flight::route('GET /test', function() {
    Flight::json(['status' => 'working']);
});
Flight::start();
?>
