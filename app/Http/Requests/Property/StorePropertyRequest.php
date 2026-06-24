<?php

namespace App\Http\Requests\Property;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->role === 'owner';
    }

    public function rules(): array
    {
        return [
            'nama_properti' => ['required', 'string', 'max:255'],
            'harga_bulanan' => ['required', 'numeric', 'min:100000'],
            'deskripsi'     => ['required', 'string'],
            'alamat'        => ['required', 'string', 'max:500'],
        ];
    }
}