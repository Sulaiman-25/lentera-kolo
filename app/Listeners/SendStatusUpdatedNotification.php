<?php

namespace App\Listeners;

use App\Models\Notification;
use App\Events\NewsStatusUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStatusUpdatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewsStatusUpdated $event): void
    {
        $news = $event->news;
        $author = $news->author;

        // Notifikasi ke penulis
        $data = [
            'type' => 'news_status_updated',
            'title' => $news->title,
            'news_id' => $news->id,
            'status' => $news->status,
            'changed_by' => auth()->user()->name ?? 'Sistem',
        ];

        Notification::create([
            'user_id' => $author->id,
            'type' => 'news_status_updated',
            'data' => json_encode($data),
            'read_at' => null,
        ]);

        // Notifikasi ke Editor jika status berubah ke pending
        if ($news->status === 'pending') {
            $editors = \App\Models\User::role('Editor')->get();

            foreach ($editors as $editor) {
                Notification::create([
                    'user_id' => $editor->id,
                    'type' => 'news_status_updated',
                    'data' => json_encode($data),
                    'read_at' => null,
                ]);
            }
        }
    }
}
