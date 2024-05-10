<?php

namespace Tests\Feature;

use App\Models\HealthCheck;
use App\Models\HealthCheckModel;
use Tests\TestCase;

class CheckHealthTest extends TestCase
{
    protected $dbHostKey = 'database.connections.mysql.host';
    protected $dbHostValue = 'mysql';
    protected $redisHostKey = 'database.redis.cache.host';
    protected $redisHostValue = 'redis';
    protected $uri = '/api/v1/health-check';
    protected $headers = [
        'X-Owner'=> '806a7b6e-e00b-4bfd-9e22-d580e7a4f261'
    ];



    protected function setUp(): void
    {
        parent::setUp();

        config([
            $this->dbHostKey => $this->dbHostValue,
            $this->redisHostKey => $this->redisHostValue,
        ]);

    }

    function test_access_to_application_with_x_owner_header()
    {
        $uri = '/api/v1/health-check';
        $headers = [
            'X-Owner'=> '806a7b6e-e00b-4bfd-9e22-d580e7a4f261'
        ];
        $response = $this->json('GET',$uri,[],$headers);//dd($response);
        $response->assertJsonStructure([
                'db',
                'cache'
            ]);
    }

    function test_access_to_application_with_x_owner_header_again()
    {
        $uri = '/api/v1/health-check';
        $headers = [
            'X-Owner'=> '806a7b6e-e00b-4bfd-9e22-d580e7a4f261'
        ];
        $response = $this->json('GET',$uri,[],$headers);
        $response->assertJsonStructure([
            'db',
            'cache'
        ]);
    }

    function test_access_to_application_with_x_owner_header_not_uuid()
    {
        $uri = '/api/v1/health-check';
        $headers = [
            'X-Owner'=> '806a7b6e-e00b-4bfd-9e22-'
        ];
        $response = $this->json('GET',$uri,[],$headers);
        $response->assertStatus(400);
        $response->assertBadRequest();
        $data = json_decode($response->getContent(),true);//dd($data);
        $this->assertArrayHasKey('Bad request',$data);

    }

    function test_access_to_application_without_x_owner_header()
    {
        $uri = '/api/v1/health-check';
        $headers = [];
        $response = $this->json('GET',$uri,[],$headers);
        $response->assertStatus(400);
        $response->assertBadRequest();
        $data = json_decode($response->getContent(),true);
        $this->assertArrayHasKey('Bad request',$data);

    }

    function test_should_return_500_error_with_json_when_db_not_available()
    {
          config([$this->dbHostKey => 'incoorectDbHost']);
          $response = $this->json('GET',$this->uri,[],$this->headers);
          $response->assertStatus(500);
          $response->assertInternalServerError();
          $response->assertJsonStructure(['db','cache']);
          $data = json_decode($response->getContent(),true);
          $this->assertEquals(false, $data['db']);
          $this->assertEquals(true, $data['cache']);

    }

    function test_should_return_500_error_with_json_when_cache_not_available()
    {
        config([$this->redisHostKey => 'incoorectRedisHost']);
        $response = $this->json('GET',$this->uri,[],$this->headers);
        $response->assertStatus(500);
        $response->assertInternalServerError();
        $response->assertJsonStructure(['db','cache']);
        $data = json_decode($response->getContent(),true);
        $this->assertEquals(true, $data['db']);
        $this->assertEquals(false, $data['cache']);

    }

    function test_should_return_500_error_with_json_when_cache_and_db_not_available()
    {
        config([
            $this->redisHostKey => 'incoorectRedisHost',
            $this->dbHostKey => 'incoorectDbHost'
        ]);
        $response = $this->json('GET',$this->uri,[],$this->headers);
        $response->assertStatus(500);
        $response->assertInternalServerError();
        $response->assertJsonStructure(['db','cache']);
        $data = json_decode($response->getContent(),true);
        $this->assertEquals(false, $data['db']);
        $this->assertEquals(false, $data['cache']);

    }

    function test_should_save_to_db_healthcheck_attempt()
    {
        $uuid = '3248cd29-1cd7-4387-9da3-4a140ba58fcf';
        $response = $this->json('GET',$this->uri,[],['X-Owner' => $uuid]);
        $response->assertJsonStructure([
            'db',
            'cache'
        ]);
        $healthCheck = HealthCheckModel::firstWhere('owner',$uuid);
        $data = json_decode($response->getContent(),true);
        $this->assertEquals($healthCheck->db, $data['db']);
        $this->assertEquals($healthCheck->cache, $data['cache']);
        HealthCheckModel::where('owner',$uuid)->delete();
    }
}