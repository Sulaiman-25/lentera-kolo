<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Notification;
use App\Events\CommentAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCommentNotification
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
    public function handle(CommentAdded $event): void
    {
        $comment = $event->comment;
        $commenter = $event->commenter;
        $item = $event->item;

        // Tentukan tipe item
        $itemType = get_class($item);

        if ($itemType === 'App\Models\News') {
            // Notifikasi ke pemilik berita
            if ($item->user_id && $item->user_id !== $commenter->id) {
                $data = [
                    'type' => 'comment_added',
                    'user_name' => $commenter->name,
                    'item_type' => 'berita',
                    'item_title' => $item->title,
                    'item_id' => $item->id,
                    'comment_content' => substr($comment->content, 0, 100),
                ];

                Notification::create([
                    'user_id' => $item->user_id,
                    'type' => 'comment_added',
                    'data' => json_encode($data),
                    'read_at' => null,
                ]);
            }

            // Notifikasi ke admin/editor untuk review
            $adminsEditors = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Super Admin', 'Editor']);
            })->pluck('id');

            foreach ($adminsEditors as $userId) {
                if ($userId !== $commenter->id) {
                    $data['for_review'] = true;
                    Notification::create([
                        'user_id' => $userId,
                        'type' => 'comment_added',
                        'data' => json_encode($data),
                        'read_at' => null,
                    ]);
                }
            }

        } elseif ($itemType === 'App\Models\TitipTulisan') {
            // Notifikasi ke admin/editor untuk tulisan tamu
            $adminsEditors = User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['Super Admin', 'Editor']);
            })->pluck('id');

            $data = [
                'type' => 'comment_added',
                'user_name' => $commenter->name,
                'item_type' => 'tulisan tamu',
                'item_title' => $item->judul,
                'item_id' => $item->id,
                'comment_content' => substr($comment->content, 0, 100),
            ];

            foreach ($adminsEditors as $userId) {
                if ($userId !== $commenter->id) {
                    Notification::create([
                        'user_id' => $userId,
                        'type' => 'comment_added',
                        'data' => json_encode($data),
                        'read_at' => null,
                    ]);
                }
            }
        }
    }
}
