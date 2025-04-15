<?php
require_once __DIR__ . '/../dao/BookDao.php';
require_once 'BaseService.php';

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
        if (!is_numeric($bookId) || $bookId <= 0) {
            throw new Exception("Invalid book ID");
        }
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
            $this->validateBookData($bookData);
            try {
                return $this->dao->addBook($bookData);
            } catch (Exception $e) {
                throw new Exception("Error adding book: " . $e->getMessage());
            }
        }
        public function updateBook($bookId, $bookData) {
            if (!is_numeric($bookId) || $bookId <= 0) {
                throw new Exception("Invalid book ID");
            }
            
            $this->validateBookData($bookData, true);
            $bookData['id'] = $bookId;
    
            try {
                return $this->dao->updateBook($bookData);
            } catch (Exception $e) {
                throw new Exception("Error updating book: " . $e->getMessage());
            }
        }
        public function deleteBook($bookId) {
            if (!is_numeric($bookId) || $bookId <= 0) {
                throw new Exception("Invalid book ID");
            }
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
        private function validateBookData($bookData, $isUpdate = false) {
            if (!$isUpdate) {
                $requiredFields = ['title', 'author', 'genre', 'description'];
                foreach ($requiredFields as $field) {
                    if (empty($bookData[$field])) {
                        throw new Exception("Missing required field: $field");
                    }
                }
            }
    
            if (isset($bookData['title']) && strlen($bookData['title']) > 255) {
                throw new Exception("Title is too long (maximum 255 characters)");
            }
    
            if (isset($bookData['author']) && strlen($bookData['author']) > 255) {
                throw new Exception("Author name is too long (maximum 255 characters)");
            }
    
            if (isset($bookData['genre']) && strlen($bookData['genre']) > 100) {
                throw new Exception("Genre is too long (maximum 100 characters)");
            }
        }
    }
?>



















}