<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rules;

class UserUpdateRequest extends FormRequest
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
        $user = $this->route('user');
        $userId = $user ? $user->id : null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($userId),
            ],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'kota_id' => ['nullable', 'integer', 'exists:kotas,id'],
            'kabupaten_id' => ['nullable', 'integer', 'exists:kabupatens,id'],
            'jenis_wilayah' => ['nullable', 'in:kota,kabupaten'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $kota = $this->input('kota_id');
            $kab = $this->input('kabupaten_id');

            if (empty($kota) && empty($kab)) {
                $validator->errors()->add('kota_id', 'Pilih salah satu: Kota atau Kabupaten.');
            }

            if (!empty($kota) && !empty($kab)) {
                $validator->errors()->add('kabupaten_id', 'Pilih salah satu saja (Kota atau Kabupaten), jangan keduanya.');
            }
        });
    }
}
