<?php

namespace App\Models;

use App\Core\Database;

class Wishlist {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll($userId) {
        $stmt = $this->db->prepare("SELECT * FROM wishlist WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($userId, $data) {
        // Check if already exists
        $stmt = $this->db->prepare("SELECT id FROM wishlist WHERE user_id = ? AND game_id = ?");
        $stmt->bind_param("is", $userId, $data['gameID']);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            return false; // Already in wishlist
        }

        $stmt = $this->db->prepare("INSERT INTO wishlist (user_id, game_id, title, sale_price, normal_price, thumb, store_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issddss", 
            $userId, 
            $data['gameID'], 
            $data['title'], 
            $data['salePrice'], 
            $data['normalPrice'], 
            $data['thumb'], 
            $data['storeID']
        );
        return $stmt->execute();
    }

    public function remove($userId, $gameId) {
        $stmt = $this->db->prepare("DELETE FROM wishlist WHERE user_id = ? AND game_id = ?");
        $stmt->bind_param("is", $userId, $gameId);
        return $stmt->execute();
    }
}
