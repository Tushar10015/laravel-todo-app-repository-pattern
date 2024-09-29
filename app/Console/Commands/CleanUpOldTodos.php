<?php

namespace App\Console\Commands;

use App\Models\Todo;
use Illuminate\Console\Command;

class CleanUpOldTodos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-up-old-todos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old todos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $thirtyDaysAgo = now()->subDays(30);

        // Find and delete completed todos older than 30 days
        Todo::where('is_completed', true)
            ->where('updated_at', '<', $thirtyDaysAgo)
            ->delete();
    }
}
