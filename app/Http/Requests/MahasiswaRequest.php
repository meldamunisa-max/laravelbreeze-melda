<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $mahasiswa = $this->route('mahasiswa');

        return [
            'nim' => ['required', 'string', 'max:20', Rule::unique('mahasiswa', 'nim')->ignore($mahasiswa)],
            'nama_mahasiswa' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'alamat' => ['required', 'string', 'max:1000'],
            'program_studi' => ['required', 'string', 'max:150'],
            'nomor_hp' => ['required', 'string', 'max:20', 'regex:/^[0-9+() .-]+$/'],
            'email' => ['required', 'email', 'max:255', Rule::unique('mahasiswa', 'email')->ignore($mahasiswa)],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_mahasiswa' => 'nama mahasiswa',
            'tempat_lahir' => 'tempat lahir',
            'tanggal_lahir' => 'tanggal lahir',
            'jenis_kelamin' => 'jenis kelamin',
            'program_studi' => 'program studi',
            'nomor_hp' => 'nomor HP',
        ];
    }
}
