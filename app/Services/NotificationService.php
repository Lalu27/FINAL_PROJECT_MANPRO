<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class NotificationService
{
    public function send(int $userId, string $message): void
    {
        // Untuk saat ini, kita catat ke sistem log Laravel terlebih dahulu
        Log::info("Notifikasi dikirim ke User ID {$userId}: {$message}");
    }
}