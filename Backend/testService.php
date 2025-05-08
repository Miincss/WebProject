<?php
require_once 'services/UserService.php';
require_once 'services/BookService.php';
require_once 'services/ReviewService.php';
require_once 'services/NewsletterService.php';
require_once 'services/ContactService.php';


$userService = new UserService();
$bookService = new BookService();
$reviewService = new ReviewService();
$newsletterService = new NewsletterService();
$contactService = new ContactService();

echo "\nTesting User Service:\n";
try {
    // Create user
    $userData = [
        'username' => 'johndoe_' . time(),
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john_' . time() . '@example.com',
        'password' => 'password123',
        'is_admin' => 0
    ];
    $userId = $userService->createUser($userData);
    echo "User created successfully with ID: $userId\n";

    // Get all users
    $allUsers = $userService->getAllUsers();
    echo "Total users found: " . count($allUsers) . "\n";

    // Get user by ID
    $user = $userService->getUserById(8);
    echo "Retrieved user: {$user['username']}\n";

    // Update user
    $updateData = [
        'username' => 'johndoe_updated_' . time(),
        'email' => 'john_updated_' . time() . '@example.com'
    ];
    $userService->updateUser(8, $updateData);
    echo "User updated successfully\n";
} catch (Exception $e) {
    echo "User service error: " . $e->getMessage() . "\n";
}

echo "\nTesting Book Service:\n";
try {
    // Create book
    $bookData = [
        'title' => 'Test Book',
        'author' => 'Test Author',
        'description' => 'A test book description',
        'genre' => 'Fiction'
    ];
    $bookId = $bookService->addBook($bookData);
    echo "Book created successfully with ID: $bookId\n";

    // Get all books
    $allBooks = $bookService->getAllBooks();
    echo "Total books found: " . count($allBooks) . "\n";

    // Get book by ID
    $book = $bookService->getBookById($bookId);
    echo "Retrieved book: {$book['title']}\n";

    // Get books by genre
    $fictionBooks = $bookService->getByGenre('Fiction');
    echo "Fiction books found: " . count($fictionBooks) . "\n";

    // Get first three books
    $featuredBooks = $bookService->getFirstThreeBooks();
    echo "Featured books retrieved: " . count($featuredBooks) . "\n";

    // Update book
    $updateBookData = [
        'title' => 'Updated Test Book',
        'description' => 'Updated description',
        'author' => 'Updated Author',
        'genre' => 'Non-Fiction'
        
    ];
    $bookService->updateBook($bookId, $updateBookData);
    echo "Book updated successfully\n";
} catch (Exception $e) {
    echo "Book service error: " . $e->getMessage() . "\n";
}

echo "\nTesting Review Service:\n";
try {
    // Create review
    $reviewData = [
        'user_id' => 8,
        'book_id' => 4,
        'rating' => 5,
        'comment' => 'Great book!'
    ];
    $reviewId = $reviewService->addReview($reviewData);
    echo "Review created successfully with ID: $reviewId\n";

    // Get review by ID
    $review = $reviewService->getByReviewId(4);
    echo "Retrieved review for book\n";

    // Get reviews by book ID
    $bookReviews = $reviewService->getByBookId(4);
    echo "Reviews found for book: " . count($bookReviews) . "\n";
} catch (Exception $e) {
    echo "Review service error: " . $e->getMessage() . "\n";
}

echo "\nTesting Newsletter Service:\n";
try {
    // Get all subscriptions
    $allSubscriptions = $newsletterService->getAllSubscriptions();
    echo "Total subscriptions found: " . count($allSubscriptions) . "\n";

    // Create subscription
    $subscriptionData = [
        'user_id' => 8,
        'email' => 'john_' . time() . '@example.com'
    ];
    $subscriptionId = $newsletterService->addSubscription($subscriptionData);
    echo "Newsletter subscription created successfully with ID: $subscriptionId\n";
} catch (Exception $e) {
    echo "Newsletter service error: " . $e->getMessage() . "\n";
}

echo "\nTesting Contact Service:\n";
try {
    // Get all messages
    $allMessages = $contactService->getAllMessages();
    echo "Total messages found: " . count($allMessages) . "\n";

    // Create contact message
    $messageData = [
        'user_id' => 8,
        'name' => 'John Doe',
        'email' => 'john_' . time() . '@example.com',
        'subject' => 'Test Subject',
        'message' => 'This is a test message'
    ];
    $messageId = $contactService->createMessage($messageData);
    echo "Contact message created successfully with ID: $messageId\n";

    // Get message by ID
    $message = $contactService->getMessageById($messageId);
    echo "Retrieved message from: {$message['name']}\n";
} catch (Exception $e) {
    echo "Contact service error: " . $e->getMessage() . "\n";
}
?>
