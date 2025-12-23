<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\CheapSharkService;

class HomeController extends Controller {
    private $service;

    public function __construct() {
        $this->service = new CheapSharkService();
    }

    public function index() {
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $storeFilter = isset($_GET['store']) ? $_GET['store'] : '';
        
        $deals = $this->service->getDeals($searchTerm, $storeFilter);
        $stores = $this->service->getStores();

        $this->view('home', [
            'deals' => $deals,
            'stores' => $stores,
            'searchTerm' => $searchTerm,
            'storeFilter' => $storeFilter
        ]);
    }
}
