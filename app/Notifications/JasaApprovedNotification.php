<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class JasaApprovedNotification extends Notification
{
    use Queueable;

    protected $jasa;

    public function __construct($jasa)
    {
        $this->jasa = $jasa;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'judul'   => 'Jasa Disetujui 🎉',
            'pesan'   => 'Selamat! Jasa "' . $this->jasa->nama_jasa . '" telah disetujui oleh admin.',
            'jasa_id' => $this->jasa->id,
        ];
    }
}
