<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewsNotification
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
    public function handle(object $event): void
    {
        $news = $event->news;

        // Notifikasi ke Editor jika berita dibuat/diperbarui
        $editors = User::role('Editor')->get();

        foreach ($editors as $editor) {
            $data = [
                'type' => 'news_created',
                'title' => $news->title,
                'news_id' => $news->id,
                'author_name' => $news->author->name,
                'status' => $news->status,
            ];

            Notification::create([
                'user_id' => $editor->id,
                'type' => 'news_created',
                'data' => json_encode($data),
                'read_at' => null,
            ]);
        }

        // Notifikasi ke Super Admin juga
        $superAdmins = User::role('Super Admin')->get();

        foreach ($superAdmins as $superAdmin) {
            $data['type'] = 'news_created';
            Notification::create([
                'user_id' => $superAdmin->id,
                'type' => 'news_created',
                'data' => json_encode($data),
                'read_at' => null,
            ]);
        }
    }
}
