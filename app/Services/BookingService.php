<?php

namespace App\Services;

use App\Models\Booking;
use Exception;

class BookingService
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function createBooking(array $data, int $userId): Booking
    {
        $booking = Booking::create([
            'user_id' => $userId,
            'property_id' => $data['property_id'],
            'durasi_sewa' => $data['durasi_sewa'],
            'status' => 'pending',
        ]);

        // Kirim notifikasi otomatis ke Owner bahwa ada booking baru
        $this->notificationService->send($booking->property->user_id, 'Ada pengajuan sewa baru untuk kost Anda!');

        return $booking;
    }
}