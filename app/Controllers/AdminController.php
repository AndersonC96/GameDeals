<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class AdminController extends Controller {
    
    private function checkAdmin() {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            $this->redirect('/login');
        }
        // For now, user with id=1 is admin (or username 'admin')
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            // Check if user is admin
            if ($_SESSION['username'] !== 'admin' && $_SESSION['id'] !== 1) {
                $this->redirect('/');
            }
        }
    }

    public function index() {
        $this->checkAdmin();
        
        $db = Database::getInstance()->getConnection();
        
        // Get statistics
        $stats = [];
        
        // Total users
        $result = $db->query("SELECT COUNT(*) as count FROM users");
        $stats['total_users'] = $result->fetch_assoc()['count'];
        
        // Total wishlist items
        $result = $db->query("SELECT COUNT(*) as count FROM wishlist");
        $stats['total_wishlist'] = $result->fetch_assoc()['count'];
        
        // Total price alerts
        $result = $db->query("SELECT COUNT(*) as count FROM price_alerts");
        $stats['total_alerts'] = $result->fetch_assoc()['count'];
        
        // Recent users
        $result = $db->query("SELECT id, username, created_at FROM users ORDER BY id DESC LIMIT 10");
        $recentUsers = $result->fetch_all(MYSQLI_ASSOC);
        
        $this->view('admin/dashboard', [
            'stats' => $stats,
            'recentUsers' => $recentUsers
        ]);
    }

    public function users() {
        $this->checkAdmin();
        
        $db = Database::getInstance()->getConnection();
        $result = $db->query("SELECT id, username, created_at FROM users ORDER BY id DESC");
        $users = $result->fetch_all(MYSQLI_ASSOC);
        
        $this->view('admin/users', ['users' => $users]);
    }

    public function deleteUser() {
        $this->checkAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if ($data && isset($data['userId']) && $data['userId'] != $_SESSION['id']) {
                $db = Database::getInstance()->getConnection();
                $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
                $stmt->bind_param("i", $data['userId']);
                $success = $stmt->execute();
                
                header('Content-Type: application/json');
                echo json_encode(['success' => $success]);
                exit;
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode(['success' => false]);
    }
}
