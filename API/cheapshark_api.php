<?php
    define('CHEAPSHARK_API_URL', 'https://www.cheapshark.com/api/1.0');
    function buscarPromocoes($searchTerm = '', $storeFilter = '', $priceFilter = ''){
        $deals = array();
        $url = CHEAPSHARK_API_URL . "/deals?";
        if(!empty($searchTerm)){
            $url .= "title=" . urlencode($searchTerm) . "&";
        }
        if(!empty($storeFilter)){
            $url .= "storeID=" . urlencode($storeFilter) . "&";
        }
        $response = file_get_contents($url);
        if($response !== false){
            $deals = json_decode($response, true);
        }
        return $deals;
    }
    function buscarDetalhesDoJogo($gameID){
        $details = array();
        $url = CHEAPSHARK_API_URL . "/games?id=" . urlencode($gameID);
        $response = file_get_contents($url);
        if($response !== false){
            $details = json_decode($response, true);
        }
        return $details;
    }