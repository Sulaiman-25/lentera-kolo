<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Notification;
use App\Events\CategoryUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCategoryNotification
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
    public function handle(CategoryUpdated $event): void
    {
        $category = $event->category;
        $action = $event->action;

        // Notifikasi ke Super Admin dan Editor
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Super Admin', 'Editor']);
        })->get();

        $actionText = $this->getActionText($action);

        $data = [
            'type' => 'category_updated',
            'category_name' => $category->name,
            'category_id' => $category->id,
            'action' => $actionText,
            'changed_by' => auth()->user()->name ?? 'Sistem',
        ];

        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => 'category_updated',
                'data' => json_encode($data),
                'read_at' => null,
            ]);
        }
    }

    private function getActionText($action)
    {
        $actions = [
            'created' => 'ditambahkan',
            'updated' => 'diperbarui',
            'deleted' => 'dihapus',
        ];

        return $actions[$action] ?? $action;
    }
}
