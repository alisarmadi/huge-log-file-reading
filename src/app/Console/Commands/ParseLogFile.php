<?php

namespace App\Console\Commands;

use App\Services\LogInventoryService;
use Illuminate\Console\Command;

class ParseLogFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:log_file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parsing the log file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $startTime = time();
        $this->info('Started adding log records ...');

        /** @var LogInventoryService $logInventoryService */
        $logInventoryService = app()->make(LogInventoryService::class);
        $totalInsertedRecords = $logInventoryService->insertFileToDB();

        $endTime = time();
        $totalTimeInSeconds = $endTime - $startTime;
        $this->info('Adding log records completed.');
        $this->info("$totalInsertedRecords records were added to the database.");
        $this->info("This operation took $totalTimeInSeconds seconds.");

        return 0;
    }
}
