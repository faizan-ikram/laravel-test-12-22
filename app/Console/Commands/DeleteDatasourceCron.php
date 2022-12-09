<?php

namespace App\Console\Commands;

use App\Models\Datasource;
use Illuminate\Console\Command;

class DeleteDatasourceCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete_old_datasource:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Datasource::whereDate('created_at', '<=', now()->subDays(30))->delete();
        return Command::SUCCESS;
    }
}
