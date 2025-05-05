<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
class ClearStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:clear-storage';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the storage folder for fresh file uploads';
    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $storagePath = storage_path('app/public'); // path to storage

        // Delete all files in the storage directory
        $files = File::allFiles($storagePath);

        foreach ($files as $file) {
            File::delete($file);  // delete each file
        }

        $this->info('Storage has been cleared.');
    }
}
