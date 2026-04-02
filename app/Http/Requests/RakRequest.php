<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah jadi true
    }

    public function rules(): array
    {
        return [
            'nama_rak' => 'required|string|max:255',
            'lokasi'   => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_rak.required' => 'Nama rak tidak boleh kosong.',
            'nama_rak.string'   => 'Nama rak harus berupa teks.',
            'lokasi.required'   => 'Lokasi rak wajib diisi.',
            'lokasi.string'     => 'Lokasi rak harus berupa teks.',
        ];
    }
}