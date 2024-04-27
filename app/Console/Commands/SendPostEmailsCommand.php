<?php

namespace App\Console\Commands;

use App\Jobs\PostNotificationJob;
use Illuminate\Console\Command;

class SendPostEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-post-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to subscribers for new posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        PostNotificationJob::dispatch();
    }
}
