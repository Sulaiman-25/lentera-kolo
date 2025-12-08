<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Notification;
use App\Events\TitipTulisanStatusUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTitipTulisanStatusNotification
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
    public function handle(TitipTulisanStatusUpdated $event): void
    {
        $titipTulisan = $event->titipTulisan;

        // Cari user berdasarkan email pengirim
        $user = User::where('email', $titipTulisan->email_pengirim)->first();

        if ($user) {
            $data = [
                'type' => 'titip_tulisan_status_updated',
                'title' => $titipTulisan->judul,
                'titip_tulisan_id' => $titipTulisan->id,
                'status' => $titipTulisan->status,
                'changed_by' => auth()->user()->name ?? 'Sistem',
            ];

            Notification::create([
                'user_id' => $user->id,
                'type' => 'titip_tulisan_status_updated',
                'data' => json_encode($data),
                'read_at' => null,
            ]);
        }

        // Notifikasi ke Super Admin juga
        $superAdmins = User::role('Super Admin')->get();

        foreach ($superAdmins as $superAdmin) {
            Notification::create([
                'user_id' => $superAdmin->id,
                'type' => 'titip_tulisan_status_updated',
                'data' => json_encode($data),
                'read_at' => null,
            ]);
        }
    }
}
