<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
{
    // 1. Ubah jadi true agar diizinkan menggunakan request ini
    public function authorize(): bool
    {
        return true; 
    }

    // 2. Tulis aturan validasinya di sini
    public function rules(): array
    {
        return [
            'nama_kategori' => 'required|string|max:255',
        ];
    }

    // 3. Tambahkan fungsi ini untuk pesan Bahasa Indonesia
    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama kategori wajib diisi, ya!',
            'nama_kategori.string'   => 'Nama kategori harus berupa teks.',
            'nama_kategori.max'      => 'Nama kategori jangan panjang-panjang (maksimal 255 karakter).',
        ];
    }
}