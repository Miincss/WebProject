<?php
require_once __DIR__ . '/../dao/BaseDao.php';

class BaseService {
    protected $dao;

    public function __construct($dao)
    {
        $this->dao = $dao;
    }

    public function getAll()
    {
        return $this->dao->getAll();
    }

    public function getById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid ID provided");
        }
        try {
            $result = $this->dao->getById($id);
            if (!$result) {
                throw new Exception("Record not found");
            }
            return $result;
        } catch (Exception $e) {
            throw new Exception("Error getting record: " . $e->getMessage());
        }
    }

    public function insert($data)
    {
        if (empty($data) || !is_array($data)) {
            throw new Exception("Invalid data provided for insertion");
        }
        try {
            return $this->dao->insert($data);
        } catch (Exception $e) {
            throw new Exception("Error inserting record: " . $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid ID provided for update");
        }
        if (empty($data) || !is_array($data)) {
            throw new Exception("Invalid data provided for update");
        }
        try {
            $exists = $this->dao->getById($id);
            if (!$exists) {
                throw new Exception("Record not found for update");
            }
            return $this->dao->update($id, $data);
        } catch (Exception $e) {
            throw new Exception("Error updating record: " . $e->getMessage());
        }
    }

    public function delete($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid ID provided");
        }
        try {
            return $this->dao->delete($id);
        } catch (Exception $e) {
            throw new Exception("Error deleting record: " . $e->getMessage());
        }
    }
}
?>