<?php

namespace Database\Factories;

use App\Models\LogInventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogInventoryFactory extends Factory
{
    protected $model = LogInventory::class;

    public function definition(): array
    {
        return [
            'service_name' => array_rand(['order-service' => 1, 'invoice-service'=> 1]),
            'log_time' => rand(1641028677, time()),
            'verb' =>   array_rand(['POST' => 1, 'GET' => 1]),
            'url' =>  array_rand(['order-service' => 1, 'invoice-service' => 1]),
            'protocol' => array_rand(['/invoices' => 1, '/orders' => 1]),
            'status' => array_rand([201 => 1 , 402 => 1])
        ];
    }
}
