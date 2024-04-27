<?php

namespace App\Jobs;

use App\Mail\PostNotification;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PostNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Post::chunk(100, function ($postChunk) {
            foreach ($postChunk as $post) {
                $subscribers = Subscription::where('status_sub', Subscription::ACTIVE)->where('post_id', $post->id);
                $subscribers->chunk(100, function ($subscriberChunk) use ($post) {
                    foreach ($subscriberChunk as $subscriber) {
                        if ($subscriber->status_post === Subscription::UNDELIVERED) {
                            try {
                                Mail::to($subscriber->email)->send(new PostNotification($post));
                                $subscriber->update(['status_post' => Subscription::DELIVERED]);

                                \Log::info("Sending email to: {$subscriber->email} Post: $post->title!");
                            } catch (\Exception $e) {
                                \Log::error("Failed to send email to: {$subscriber->email} Post: {$post->title}. Error: {$e->getMessage()}");
                            }
                        }
                    }
                });
            }
        });
    }
}
