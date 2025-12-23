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
        $searchTerm = $_GET['search'] ?? '';
        $storeFilter = $_GET['store'] ?? '';
        $priceFilter = $_GET['price'] ?? '';
        $page = isset($_GET['page']) ? max(0, intval($_GET['page'])) : 0;
        $sortBy = $_GET['sort'] ?? 'Deal Rating';
        $minDiscount = isset($_GET['discount']) ? intval($_GET['discount']) : 0;
        
        $deals = $this->service->getDeals($searchTerm, $storeFilter, $priceFilter, $page, $sortBy, $minDiscount);
        $stores = $this->service->getStores();

        $this->view('home', [
            'deals' => $deals,
            'stores' => $stores,
            'searchTerm' => $searchTerm,
            'storeFilter' => $storeFilter,
            'priceFilter' => $priceFilter,
            'currentPage' => $page,
            'sortBy' => $sortBy,
            'minDiscount' => $minDiscount
        ]);
    }
}
