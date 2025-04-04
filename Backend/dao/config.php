<?php
class Database {
    private const HOST = '127.0.0.1'; 
    private const DB_NAME = 'bookbite';
    private const USERNAME = 'root';
    private const PASSWORD = '12345678';
    private const CHARSET = 'utf8mb4';
    
    public static function connect() {
        try {
            $dsn = "mysql:host=" . self::HOST . 
                   ";dbname=" . self::DB_NAME . 
                   ";charset=" . self::CHARSET;
                   
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            return new PDO($dsn, self::USERNAME, self::PASSWORD, $options);
        } catch(PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }
}
?>