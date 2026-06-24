<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'mahasiswa';
    }

    public function rules(): array
    {
        return [
            'property_id' => ['required', 'exists:properties,id'],
            'durasi_sewa' => ['required', 'integer', 'min:1', 'max:36'], // maksimal 36 bulan
        ];
    }
}