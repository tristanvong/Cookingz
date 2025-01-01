<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the application log file (laravel.log)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logFilePath = storage_path('logs/laravel.log');

        if (File::exists($logFilePath)) {
            File::delete($logFilePath);
            touch($logFilePath);
            $this->info('laravel.log has been cleared.');
        } else {
            $this->info('laravel.log does not exist.');
        }
    }
}
