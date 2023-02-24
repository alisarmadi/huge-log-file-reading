<?php

namespace Tests\Unit\LogInventory\Services;

use App\Services\LogInventoryService;
use Tests\TestCase;

class LogInventoryServiceTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function setLineToRecordTest()
    {
        $logInventoryTestData = require(__DIR__ . '/../Fixtures/LogInventoryTestData.php');

        /** @var LogInventoryService $logInventoryService */
        $logInventoryService = app()->make(LogInventoryService::class);

        $errorMessage = 'This line is not a valid log record.';
        foreach($logInventoryTestData['file_lines'] as $index => $line) {
            $record = $logInventoryService->setLineToRecord($line);
            $this->assertIsArray($record, $errorMessage);

            foreach($logInventoryTestData['set_result'][$index] as $label => $value) {
                $this->assertEquals($record[$label], $value, $errorMessage);
            }
        }
    }
}


