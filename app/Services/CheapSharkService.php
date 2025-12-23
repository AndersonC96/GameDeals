<?php

namespace App\Services;

class CheapSharkService {
    const API_URL = 'https://www.cheapshark.com/api/1.0';
    private $cache;

    public function __construct() {
        $this->cache = new CacheService();
    }

    public function getDeals($searchTerm = '', $storeFilter = '', $priceFilter = '', $page = 0, $sortBy = 'Deal Rating', $minDiscount = 0) {
        $url = self::API_URL . "/deals?";
        
        $params = [
            'pageNumber' => $page,
            'pageSize' => 20,
            'sortBy' => $sortBy
        ];
        
        if (!empty($searchTerm)) {
            $params['title'] = $searchTerm;
        }
        if (!empty($storeFilter)) {
            $params['storeID'] = $storeFilter;
        }
        if ($minDiscount > 0) {
            $params['onSale'] = 1;
        }
        if (!empty($priceFilter) && is_numeric($priceFilter)) {
            $params['upperPrice'] = $priceFilter;
        }
        
        $url .= http_build_query($params);

        return $this->request($url, 180); // Cache for 3 minutes
    }

    public function getStores() {
        $url = self::API_URL . "/stores";
        $stores = $this->request($url, 3600); // Cache for 1 hour
        
        $storeMap = [];
        if ($stores) {
            foreach ($stores as $store) {
                if ($store['isActive'] == 1) {
                    $storeMap[$store['storeID']] = $store['storeName'];
                }
            }
        }
        return $storeMap;
    }

    public function getGameDetails($gameID) {
        $url = self::API_URL . "/games?id=" . $gameID;
        return $this->request($url, 600); // Cache for 10 minutes
    }

    private function request($url, $cacheTTL = 300) {
        // Check cache first
        $cached = $this->cache->get($url);
        if ($cached !== null) {
            return $cached;
        }
        
        // Make API request
        $response = @file_get_contents($url);
        if ($response !== false) {
            $data = json_decode($response, true);
            $this->cache->set($url, $data, $cacheTTL);
            return $data;
        }
        return [];
    }
}

