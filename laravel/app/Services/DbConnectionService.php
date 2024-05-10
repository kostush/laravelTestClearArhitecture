<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use Src\Domains\HealthCheck\Interfaces\DbConnectionInterface;

class DbConnectionService implements DbConnectionInterface
{
    public function checkConnection(): bool
    {
        try{
            DB::connection()->getPdo();
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}
