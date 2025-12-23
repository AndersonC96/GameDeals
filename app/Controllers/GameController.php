<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\CheapSharkService;

class GameController extends Controller {
    public function show() {
        $gameID = $_GET['id'] ?? null;
        if (!$gameID) {
            $this->redirect('/');
        }

        $service = new CheapSharkService();
        $details = $service->getGameDetails($gameID);
        $stores = $service->getStores();

        if (!$details) {
            echo "Jogo não encontrado."; // Better error handling needed
            return;
        }

        $this->view('game', [
            'game' => $details,
            'stores' => $stores
        ]);
    }
}
