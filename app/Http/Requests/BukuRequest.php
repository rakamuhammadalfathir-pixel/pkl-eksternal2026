<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'       => 'required|string|max:255',
            'pengarang'   => 'required|string|max:255',
            'sinopsis'    => 'nullable|string',
            'penerbit'    => 'required|string|max:255',
            'tahun'       => 'required|numeric|digits:4|min:1900|max:' . date('Y'),
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'rak_id'      => 'required|exists:raks,id',
            'foto'        => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'       => 'Judul buku wajib diisi.',
            'pengarang.required'   => 'Nama pengarang wajib diisi.',
            'penerbit.required'    => 'Nama penerbit wajib diisi.',
            'tahun.required'       => 'Tahun terbit wajib diisi.',
            'tahun.digits'         => 'Tahun harus berupa 4 digit angka.',
            'tahun.max'            => 'Tahun terbit tidak boleh melebihi tahun sekarang.',
            'stok.required'        => 'Jumlah stok wajib diisi.',
            'stok.min'             => 'Stok tidak boleh kurang dari 0.',
            'kategori_id.required' => 'Silahkan pilih kategori buku.',
            'kategori_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'rak_id.required'      => 'Silahkan pilih lokasi rak.',
            'rak_id.exists'        => 'Rak yang dipilih tidak valid.',
            'foto.image'           => 'File harus berupa gambar.',
            'foto.mimes'           => 'Format gambar harus jpg, png, atau jpeg.',
            'foto.max'             => 'Ukuran gambar maksimal adalah 2MB.',
        ];
    }
}