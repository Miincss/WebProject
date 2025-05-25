<?php
require_once __DIR__ . '/../dao/BookDao.php';
require_once 'BaseService.php';
require_once 'Validator.php';

class BookService extends BaseService {
    public function __construct() {
        parent::__construct(new BookDao());
    }

    public function getByGenre($genre) {
        if (empty($genre)) {
            throw new Exception("Genre cannot be empty");
        }
        try {
            return $this->dao->getByGenre($genre);
        } catch (Exception $e) {
            throw new Exception("Error getting books by genre: " . $e->getMessage());
        }
    }

    public function getBookById($bookId) {
        Validator::validateId($bookId, 'book');
        try {
            $book = $this->dao->getById($bookId);
            if (!$book) {
                throw new Exception("Book not found");
            }
            return $book;
        } catch (Exception $e) {
            throw new Exception("Error retrieving book: " . $e->getMessage());
        }
    }

    public function getAllBooks() {
        try {
            return $this->dao->getAll();
        } catch (Exception $e) {
            throw new Exception("Error retrieving all books: " . $e->getMessage());
        }
    }

    public function addBook($bookData) {
        Validator::validateBookData($bookData);
        try {
            return $this->dao->addBook($bookData);
        } catch (Exception $e) {
            throw new Exception("Error adding book: " . $e->getMessage());
        }
    }

    public function updateBook($bookId, $bookData) {
        Validator::validateId($bookId, 'book');
        Validator::validateBookData($bookData, true);
        $bookData['id'] = $bookId;

        try {
            return $this->dao->updateBook($bookData);
        } catch (Exception $e) {
            throw new Exception("Error updating book: " . $e->getMessage());
        }
    }

    public function deleteBook($bookId) {
        Validator::validateId($bookId, 'book');
        try {
            return $this->dao->delete($bookId);
        } catch (Exception $e) {
            throw new Exception("Error deleting book: " . $e->getMessage());
        }
    }

    public function getFirstThreeBooks() {
        try {
            return $this->dao->getFirstThreeBooks();
        } catch (Exception $e) {
            throw new Exception("Error retrieving featured books: " . $e->getMessage());
        }
    }
}
?>