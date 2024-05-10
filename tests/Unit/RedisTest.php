<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RedisTest extends TestCase
{
    function test_redis_is_accessible()
    {

        $resultSet = Cache::store('redis')->set('test_record', 'test');
        $resultDelete = Cache::store('redis')->delete('test_record', 'test');
        $this->assertNotEmpty($resultSet);
        $this->assertNotEmpty($resultDelete);
    }

}
