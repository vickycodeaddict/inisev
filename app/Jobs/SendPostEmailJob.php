<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

use App\Models\Post;
use App\Models\User;

class SendPostEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;
    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Execute the job to send an email notification for a new post.
     *
     * This method sends an email to the user with the description of the post.
     * It also adds a CC recipient for additional notification.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::raw(strip_tags($this->post->description), function ($message) {
            $message->to($this->user->email)
                    ->cc(['vickycodeaddict@mailinator.com'])
                    ->subject('New Post Published: ' . $this->post->title)
                    ->send();
        });
    }
}
