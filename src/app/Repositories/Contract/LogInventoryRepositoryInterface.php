<?php
namespace App\Repositories\Contract;

interface LogInventoryRepositoryInterface
{
    public function createMany($items);

    public function listCount(array $filters);
}
