<?php

namespace App\Services;

class CheapSharkService {
    const API_URL = 'https://www.cheapshark.com/api/1.0';

    public function getDeals($searchTerm = '', $storeFilter = '', $priceFilter = '') {
        $url = self::API_URL . "/deals?";
        
        $params = [];
        if (!empty($searchTerm)) {
            $params['title'] = $searchTerm;
        }
        if (!empty($storeFilter)) {
            $params['storeID'] = $storeFilter;
        }
        // Price filter logic could be added here if API supports it or manually filtered
        
        $url .= http_build_query($params);

        return $this->request($url);
    }

    public function getStores() {
        $url = self::API_URL . "/stores";
        $stores = $this->request($url);
        
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
        return $this->request($url);
    }

    private function request($url) {
        // Implement simple caching here if needed later
        $response = @file_get_contents($url);
        if ($response !== false) {
            return json_decode($response, true);
        }
        return [];
    }
}
