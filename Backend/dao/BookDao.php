<?php
require_once 'BaseDao.php';

class BookDao extends BaseDao {
    public function __construct() {
        parent::__construct("Books", "book_id");
    }

    public function getByGenre($genre) {
        $stmt = $this->connection->prepare("SELECT * FROM books WHERE genre = :genre");
        $stmt->bindParam(':genre', $genre);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM books WHERE book_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE book_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM books");
        $stmt->execute();
        return $stmt->fetchAll();
    }  

    public function addBook($book) {
        $stmt = $this->connection->prepare("INSERT INTO books (title, author, genre, description, photo) VALUES (:title, :author, :genre, :description, :photo)");
        $stmt->bindParam(':title', $book['title']);
        $stmt->bindParam(':author', $book['author']);
        $stmt->bindParam(':genre', $book['genre']);
        $stmt->bindParam(':description', $book['description']);
        $stmt->execute();
    }
        


    public function updateBook($book) {
        $stmt = $this->connection->prepare("UPDATE books SET title = :title, author = :author, genre = :genre, description = :description, photo = :photo WHERE book_id = :id");
        $stmt->bindParam(':title', $book['title']);
        $stmt->bindParam(':author', $book['author']);
        $stmt->bindParam(':genre', $book['genre']);
        $stmt->bindParam(':description', $book['description']);
        $stmt->execute();
    }

    public function getFirstThreeBooks() {
        $stmt = $this->connection->prepare("SELECT * FROM books LIMIT 3");
        $stmt->execute();
        return $stmt->fetchAll();

    }
}
?>