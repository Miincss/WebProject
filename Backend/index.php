<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

// Enable Flight debug mode
Flight::set('flight.log_errors', true);
Flight::set('flight.handle_errors', true);

// Include service files
require_once __DIR__ . '/services/BaseService.php';
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/BookService.php';
require_once __DIR__ . '/services/ReviewService.php';
require_once __DIR__ . '/services/ContactService.php';
require_once __DIR__ . '/services/NewsletterService.php';

// Register services with new instances
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

// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Include all route files
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/BookRoutes.php';
require_once __DIR__ . '/routes/ReviewRoutes.php';
require_once __DIR__ . '/routes/ContactRoutes.php';
require_once __DIR__ . '/routes/NewsletterRoutes.php';

// Add this before Flight::start();
Flight::route('GET /test', function() {
    Flight::json(['status' => 'working']);
});
Flight::start();
?>
