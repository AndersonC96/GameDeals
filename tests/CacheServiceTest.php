<?php

use PHPUnit\Framework\TestCase;

// Bootstrap for tests
require_once __DIR__ . '/../public/index.php';

class CacheServiceTest extends TestCase {
    
    private $cache;
    
    protected function setUp(): void {
        $this->cache = new \App\Services\CacheService();
    }
    
    public function testSetAndGet(): void {
        $key = 'test_key_' . time();
        $value = ['data' => 'test value'];
        
        $this->cache->set($key, $value, 60);
        $retrieved = $this->cache->get($key);
        
        $this->assertEquals($value, $retrieved);
    }
    
    public function testExpiredCache(): void {
        $key = 'expired_key_' . time();
        $value = 'test';
        
        // Set with 0 TTL (already expired)
        $this->cache->set($key, $value, -1);
        $retrieved = $this->cache->get($key);
        
        $this->assertNull($retrieved);
    }
    
    public function testNonExistentKey(): void {
        $retrieved = $this->cache->get('non_existent_key_' . time());
        $this->assertNull($retrieved);
    }
}
