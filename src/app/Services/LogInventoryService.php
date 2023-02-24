<?php

namespace App\Services;

use App\Repositories\Contract\LogInventoryRepositoryInterface;
use Carbon\Carbon;

class LogInventoryService
{
    public function __construct(protected LogInventoryRepositoryInterface $logInventoryRepository)
    {
        //
    }

    /**
     * @return int
     */
    public function insertFileToDB(): int
    {
        $totalInsertedRecords = 0;
        $lines = [];
        $count = 0;
        $insertChunkSize = 1000;
        $path = storage_path('logs.txt');
        $handle = fopen($path, "r");
        if ($handle) {
            while (!feof($handle)) {
                $line = fgets($handle);
                if ($record = $this->setLineToRecord($line)) {
                    dd($record);
                    $lines[] = $record;
                    $count++;
                }

                if ($count === $insertChunkSize) {
                    $this->logInventoryRepository->createMany($lines);
                    $lines = [];
                    $count = 0;
                    $totalInsertedRecords += $insertChunkSize;
                }
            }
            if (count($lines) > 0) {
                $this->logInventoryRepository->createMany($lines);
                $totalInsertedRecords += count($lines);
            }
        }

        return $totalInsertedRecords;
    }

    public function setLineToRecord(string $line): array|null
    {
        $regex = '/^(\S+) - \[([^:]+:\d+:\d+:\d+)\] \"(\S+) (.*?) (\S+)\" (\S+)$/i';
        preg_match($regex, trim($line), $matches);
        if (!empty($matches)) {
            $logTime = Carbon::createFromFormat('d/M/Y:h:i:s', $matches[2]);
            return [
                'service_name' => $matches[1],
                'log_time' => $logTime->getTimestamp(),
                'verb' => $matches[3],
                'url' => $matches[4],
                'protocol' => $matches[5],
                'status' => (int)$matches[6]
            ];
        } else {
            return null;
        }
    }

    public function inventoryCount(array $filters)
    {
        return $this->logInventoryRepository->listCount($filters);
    }
}
