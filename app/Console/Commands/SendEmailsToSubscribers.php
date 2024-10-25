<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendPostEmailJob;
use App\Models\Website;

class SendEmailsToSubscribers extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new posts to subscribers';

    /**
     * Execute the console command.
     *
     * This command will iterate through all websites, get their new posts
     * and send them to all subscribers.
     *
     * For each post, it will also keep track of which subscribers have
     * already received the post, so it won't be sent twice to the same
     * subscriber.
     */
    public function handle() {
        $websites = Website::with(['posts', 'subscribers'])->get();

        foreach ($websites as $website) {
            foreach ($website->posts as $post) {
                $website->subscribers()->chunk(100, function ($subscribers) use ($post) {
                    
                    foreach ($subscribers as $subscriber) {
                        $alreadySent = $post->recipients()->where('user_id', $subscriber->id)->exists();

                        if (!$alreadySent) {
                            SendPostEmailJob::dispatch($post, $subscriber);
                            $post->recipients()->attach($subscriber->id);
                        }
                    }
                });
            }
        }

        $this->info('Emails have been dispatched to subscribers.');
    }
}
