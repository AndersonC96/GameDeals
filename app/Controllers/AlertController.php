<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PriceAlert;
use App\Services\CheapSharkService;

class AlertController extends Controller {
    
    private function checkAuth() {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Not authenticated']);
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        
        $alertModel = new PriceAlert();
        $alerts = $alertModel->getAll($_SESSION['id']);
        
        $service = new CheapSharkService();
        $stores = $service->getStores();

        $this->view('alerts', [
            'alerts' => $alerts, 
            'stores' => $stores
        ]);
    }

    public function add() {
        $this->checkAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if ($data && isset($data['gameID']) && isset($data['targetPrice'])) {
                $alertModel = new PriceAlert();
                $success = $alertModel->add(
                    $_SESSION['id'], 
                    $data['gameID'],
                    $data['title'],
                    floatval($data['targetPrice']),
                    floatval($data['currentPrice']),
                    $data['thumb']
                );
                
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
                $alertModel = new PriceAlert();
                $success = $alertModel->remove($_SESSION['id'], $data['gameID']);
                
                header('Content-Type: application/json');
                echo json_encode(['success' => $success]);
                exit;
            }
        }
    }
}
