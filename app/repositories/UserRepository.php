<?php

namespace Repositories;
use PDO;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new \Database();
    }

    public function findById($id)
    {
        $sql = "SELECT id, username FROM users WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
