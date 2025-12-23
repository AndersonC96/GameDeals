<?php

namespace App\Models;

use App\Core\Database;

class PriceAlert {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll($userId) {
        $stmt = $this->db->prepare("SELECT * FROM price_alerts WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($userId, $gameId, $title, $targetPrice, $currentPrice, $thumb) {
        // Check if already exists
        $stmt = $this->db->prepare("SELECT id FROM price_alerts WHERE user_id = ? AND game_id = ?");
        $stmt->bind_param("is", $userId, $gameId);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO price_alerts (user_id, game_id, title, target_price, current_price, thumb) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdds", $userId, $gameId, $title, $targetPrice, $currentPrice, $thumb);
        return $stmt->execute();
    }

    public function remove($userId, $gameId) {
        $stmt = $this->db->prepare("DELETE FROM price_alerts WHERE user_id = ? AND game_id = ?");
        $stmt->bind_param("is", $userId, $gameId);
        return $stmt->execute();
    }

    public function checkAlerts($userId) {
        // This would typically be run by a cron job
        // For now, returns alerts where current price is at or below target
        $stmt = $this->db->prepare("SELECT * FROM price_alerts WHERE user_id = ? AND current_price <= target_price");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
