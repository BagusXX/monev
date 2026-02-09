<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RapatStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $toBoolInt = static function ($value): ?int {
            if ($value === null) {
                return null;
            }
            $value = is_string($value) ? strtolower(trim($value)) : $value;
            if ($value === 'iya' || $value === true || $value === 1 || $value === '1') {
                return 1;
            }
            if ($value === 'tidak' || $value === false || $value === 0 || $value === '0') {
                return 0;
            }
            return null;
        };

        $this->merge([
            'bulan' => is_string($this->bulan) ? trim($this->bulan) : $this->bulan,
            'tanggal' => is_string($this->tanggal) ? trim($this->tanggal) : $this->tanggal,
            'waktu' => is_string($this->waktu) ? trim($this->waktu) : $this->waktu,
            'rapat_dptd' => $toBoolInt($this->rapat_dptd),
            'rapat_phdpd' => $toBoolInt($this->rapat_phdpd),
            'rapat_pimpinan' => $toBoolInt($this->rapat_pimpinan),
            'rapat_bidang' => $toBoolInt($this->rapat_bidang),
            'rapat_kpd' => $toBoolInt($this->rapat_kpd),
            'rapat_dewan' => $toBoolInt($this->rapat_dewan),
            'uraian_dptd' => is_string($this->uraian_dptd) ? trim($this->uraian_dptd) : $this->uraian_dptd,
            'uraian_phdpd' => is_string($this->uraian_phdpd) ? trim($this->uraian_phdpd) : $this->uraian_phdpd,
            'uraian_pimpinan' => is_string($this->uraian_pimpinan) ? trim($this->uraian_pimpinan) : $this->uraian_pimpinan,
            'uraian_bidang' => is_string($this->uraian_bidang) ? trim($this->uraian_bidang) : $this->uraian_bidang,
            'uraian_kpd' => is_string($this->uraian_kpd) ? trim($this->uraian_kpd) : $this->uraian_kpd,
            'uraian_dewan' => is_string($this->uraian_dewan) ? trim($this->uraian_dewan) : $this->uraian_dewan,
        ]);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bulan' => ['required', 'regex:/^\d{4}-(0[1-9]|1[0-2])$/'],
            'tanggal' => ['required', 'date'],
            'waktu' => ['nullable', 'date_format:H:i'],

            'rapat_dptd' => ['required', 'boolean'],
            'uraian_dptd' => ['nullable', 'string'],

            'rapat_phdpd' => ['required', 'boolean'],
            'uraian_phdpd' => ['nullable', 'string'],

            'rapat_pimpinan' => ['required', 'boolean'],
            'uraian_pimpinan' => ['nullable', 'string'],

            'rapat_bidang' => ['required', 'boolean'],
            'uraian_bidang' => ['nullable', 'string'],

            'rapat_kpd' => ['nullable', 'boolean'],
            'uraian_kpd' => ['nullable', 'string'],

            'rapat_dewan' => ['nullable', 'boolean'],
            'uraian_dewan' => ['nullable', 'string'],
        ];
    }
}

