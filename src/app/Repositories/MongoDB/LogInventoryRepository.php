<?php

namespace App\Repositories\MongoDB;

use App\Models\LogInventory;
use App\Repositories\Contract\LogInventoryRepositoryInterface;

class LogInventoryRepository extends BaseRepository implements LogInventoryRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(LogInventory::class);
    }

    public function listCount(array $filters)
    {
        $query = $this->model->newQuery();
        if (isset($filters['serviceNames'])) {
            $query = $query->whereIN('service_name', $filters['serviceNames']);
        }
        if (isset($filters['statusCode'])) {
            $query = $query->where('status', (int)$filters['statusCode']);
        }
        if (isset($filters['startDate'])) {
            $query = $query->where('log_time', '>=', (int)$filters['startDate']);
        }
        if (isset($filters['endDate'])) {
            $query = $query->where('log_time', '<=', (int)$filters['endDate']);
        }
        return $query->count();
    }

}
