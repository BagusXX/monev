<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KegiatanStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $toDigits = static function ($value): ?string {
            if ($value === null) {
                return null;
            }
            $value = (string) $value;
            $digitsOnly = preg_replace('/[^\d]/', '', $value);
            return $digitsOnly === '' ? null : $digitsOnly;
        };

        $rows = $this->input('kegiatan', []);
        if (! is_array($rows)) {
            $rows = [];
        }

        $out = [];
        foreach ($rows as $i => $row) {
            if (! is_array($row)) {
                continue;
            }
            $nk = isset($row['nama_kegiatan']) ? trim((string) $row['nama_kegiatan']) : '';
            if ($nk === '') {
                continue;
            }
            $out[] = [
                'tema' => isset($row['tema']) ? trim((string) $row['tema']) : '',
                'bidang' => isset($row['bidang']) ? trim((string) $row['bidang']) : '',
                'tanggal_pelaksanaan' => isset($row['tanggal_pelaksanaan']) ? trim((string) $row['tanggal_pelaksanaan']) : '',
                'nama_kegiatan' => $nk,
                'pelaksana' => isset($row['pelaksana']) ? trim((string) $row['pelaksana']) : '',
                'jumlah_peserta' => $toDigits($row['jumlah_peserta'] ?? null),
                'anggaran' => $toDigits($row['anggaran'] ?? null),
            ];
        }

        $this->merge(['kegiatan' => $out]);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kegiatan' => ['required', 'array', 'min:1'],
            'kegiatan.*.tema' => ['required', 'string', 'in:kaderisasi,strukturisasi,citra partai'],
            'kegiatan.*.bidang' => ['required', 'string', 'max:255'],
            'kegiatan.*.tanggal_pelaksanaan' => ['required', 'date'],
            'kegiatan.*.nama_kegiatan' => ['required', 'string', 'max:255'],
            'kegiatan.*.pelaksana' => ['required', 'string', 'max:255'],
            'kegiatan.*.jumlah_peserta' => ['required', 'integer', 'min:0'],
            'kegiatan.*.anggaran' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'kegiatan.required' => 'Minimal satu kegiatan harus diisi.',
            'kegiatan.min' => 'Minimal satu kegiatan harus diisi.',
        ];
    }
}
