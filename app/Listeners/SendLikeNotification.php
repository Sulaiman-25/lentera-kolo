<?php

namespace App\Listeners;

use App\Models\Notification;
use App\Events\LikeAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLikeNotification
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
    public function handle(LikeAdded $event): void
    {
        $liker = $event->liker;
        $item = $event->item;

        // Tentukan tipe item
        $itemType = get_class($item);

        // Notifikasi ke pemilik item
        if ($item->user_id && $item->user_id !== $liker->id) {
            if ($itemType === 'App\Models\News') {
                $data = [
                    'type' => 'like_added',
                    'user_name' => $liker->name,
                    'item_type' => 'berita',
                    'item_title' => $item->title,
                    'item_id' => $item->id,
                ];
            } elseif ($itemType === 'App\Models\TitipTulisan') {
                $data = [
                    'type' => 'like_added',
                    'user_name' => $liker->name,
                    'item_type' => 'tulisan tamu',
                    'item_title' => $item->judul,
                    'item_id' => $item->id,
                ];
            }

            Notification::create([
                'user_id' => $item->user_id,
                'type' => 'like_added',
                'data' => json_encode($data),
                'read_at' => null,
            ]);
        }
    }
}
