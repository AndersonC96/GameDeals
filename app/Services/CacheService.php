<?php

namespace App\Services;

class CacheService {
    private $cacheDir;
    private $defaultTTL = 300; // 5 minutes

    public function __construct() {
        $this->cacheDir = __DIR__ . '/../../cache/';
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    public function get($key) {
        $file = $this->getFilePath($key);
        
        if (!file_exists($file)) {
            return null;
        }
        
        $data = json_decode(file_get_contents($file), true);
        
        if ($data['expires'] < time()) {
            unlink($file);
            return null;
        }
        
        return $data['value'];
    }

    public function set($key, $value, $ttl = null) {
        $ttl = $ttl ?? $this->defaultTTL;
        $file = $this->getFilePath($key);
        
        $data = [
            'expires' => time() + $ttl,
            'value' => $value
        ];
        
        file_put_contents($file, json_encode($data));
    }

    private function getFilePath($key) {
        return $this->cacheDir . md5($key) . '.cache';
    }
}
