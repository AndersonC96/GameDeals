<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Wishlist;
use App\Services\CheapSharkService;

class WishlistController extends Controller {
    
    private function checkAuth() {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            $this->redirect('login');
        }
    }

    public function index() {
        $this->checkAuth();
        
        $wishlistModel = new Wishlist();
        $wishlist = $wishlistModel->getAll($_SESSION['id']);
        
        $service = new CheapSharkService();
        $stores = $service->getStores();

        $this->view('wishlist', [
            'deals' => $wishlist, 
            'stores' => $stores
        ]);
    }

    public function add() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if ($data) {
                $wishlistModel = new Wishlist();
                $success = $wishlistModel->add($_SESSION['id'], $data);
                
                header('Content-Type: application/json');
                echo json_encode(['success' => $success]);
                exit;
            }
        }
    }

    public function remove() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if ($data && isset($data['gameID'])) {
                $wishlistModel = new Wishlist();
                $success = $wishlistModel->remove($_SESSION['id'], $data['gameID']);
                
                header('Content-Type: application/json');
                echo json_encode(['success' => $success]);
                exit;
            }
        }
    }
}
