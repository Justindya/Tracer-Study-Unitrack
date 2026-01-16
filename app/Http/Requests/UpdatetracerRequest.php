<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatetracerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'alumni_id' => 'required|exists:alumni,id',
            'status' => 'required|in:bekerja,wiraswasta,melanjutkan,tidak bekerja',
            'mulai_kerja' => 'required|date',
            'nama_instansi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kesesuaian_kerja' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kab_kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'tgl_update' => 'required|date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'alumni_id.required' => 'Alumni harus dipilih.',
            'alumni_id.exists' => 'Alumni yang dipilih tidak valid.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status tidak valid.',
            'mulai_kerja.required' => 'Tanggal mulai kerja harus diisi.',
            'mulai_kerja.date' => 'Format tanggal mulai kerja tidak valid.',
            'nama_instansi.required' => 'Nama instansi harus diisi.',
            'nama_instansi.max' => 'Nama instansi maksimal 255 karakter.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'jabatan.max' => 'Jabatan maksimal 255 karakter.',
            'kesesuaian_kerja.required' => 'Kesesuaian kerja harus diisi.',
            'kesesuaian_kerja.max' => 'Kesesuaian kerja maksimal 255 karakter.',
            'kelurahan.required' => 'Kelurahan harus diisi.',
            'kelurahan.max' => 'Kelurahan maksimal 255 karakter.',
            'kab_kota.required' => 'Kabupaten/Kota harus diisi.',
            'kab_kota.max' => 'Kabupaten/Kota maksimal 255 karakter.',
            'provinsi.required' => 'Provinsi harus diisi.',
            'provinsi.max' => 'Provinsi maksimal 255 karakter.',
            'kode_pos.required' => 'Kode pos harus diisi.',
            'kode_pos.max' => 'Kode pos maksimal 10 karakter.',
            'tgl_update.required' => 'Tanggal update harus diisi.',
            'tgl_update.date' => 'Format tanggal update tidak valid.',
        ];
    }
}
