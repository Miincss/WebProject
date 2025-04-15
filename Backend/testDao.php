<?php
require_once 'dao/UserDao.php';
require_once 'dao/BookDao.php';
require_once 'dao/ReviewDao.php';
require_once 'dao/NewsletterDao.php';
require_once 'dao/ContactDao.php';

$userDao = new UserDao();
$bookDao = new BookDao();
$reviewDao = new ReviewDao();
$newsletterDao = new NewsletterDao();
$contactDao = new ContactDao();

echo "\nTesting User Operations:\n";
try {
    $user = $userDao->insertUser([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'username' => 'johndoe_' . time(),
        'email' => 'john_' . time() . '@example.com',
        'password' => password_hash('password123', PASSWORD_DEFAULT),
        'is_admin' => 0
    ]);
    echo "User inserted with ID: $user\n";

    $users = $userDao->getAll();
    echo "Total users: " . count($users) . "\n";
} catch (Exception $e) {
    echo "User operation error: " . $e->getMessage() . "\n";
}

echo "\nTesting Book Operations:\n";
try {
    $bookId = $bookDao->insert([
        'title' => 'Test Book',
        'author' => 'Test Author',
        'description' => 'A test book description',
        'genre' => 'Fiction'
    ]);
    echo "Book inserted with ID: $bookId\n";

    $books = $bookDao->getAll();
    echo "Total books: " . count($books) . "\n";

    $fictionBooks = $bookDao->getByGenre('Fiction');
    echo "Fiction books found: " . count($fictionBooks) . "\n";
} catch (Exception $e) {
    echo "Book operation error: " . $e->getMessage() . "\n";
}

echo "\nTesting Review Operations:\n";
try {
    $reviewId = $reviewDao->insert([
        'user_id' => 1,
        'book_id' => 1,
        'rating' => 5,
        'comment' => 'Great book!'
    ]);
    echo "Review inserted with ID: $reviewId\n";

    $bookReviews = $reviewDao->getByBookId($bookId);
    echo "Reviews for book: " . count($bookReviews) . "\n";
} catch (Exception $e) {
    echo "Review operation error: " . $e->getMessage() . "\n";
}

echo "\nTesting Newsletter Operations:\n";
try {
    $subscriptionId = $newsletterDao->insert([
        'user_id' => 1,
        'email' => 'john_' . time() . '@example.com'
    ]);
    echo "Newsletter subscription added with ID: $subscriptionId\n";

    
    $subscriptions = $newsletterDao->getAll();
    echo "Total subscriptions: " . count($subscriptions) . "\n";
} catch (Exception $e) {
    echo "Newsletter operation error: " . $e->getMessage() . "\n";
}

echo "\nTesting Contact Operations:\n";
try {
    $messageId = $contactDao->insert([
        'user_id' => 1,
        'name' => 'John Doe',
        'email' => 'john_' . time() . '@example.com',
        'subject' => 'Test Subject',
        'message' => 'This is a test message'
    ]);
    echo "Contact message added with ID: $messageId\n";

    $messages = $contactDao->getAll();
    echo "Total messages: " . count($messages) . "\n";
} catch (Exception $e) {
    echo "Contact operation error: " . $e->getMessage() . "\n";
}
?>