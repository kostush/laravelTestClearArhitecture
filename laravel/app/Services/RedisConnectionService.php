<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;

use Src\Domains\HealthCheck\Interfaces\RedisConnectionInterface;

class RedisConnectionService implements RedisConnectionInterface
{
    public function checkConnection(): bool
    {
        try{
            $set = Cache::store('redis')->set( 'test','ooooooo');
            $delete = Cache::store('redis')->delete( 'test');

            return  true;
        }catch(\Exception $e){
            return false;
        }
    }
}
