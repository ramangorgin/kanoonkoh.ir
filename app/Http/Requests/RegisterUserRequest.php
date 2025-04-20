<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Morilog\Jalali\Jalalian;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('birth_date')) {
            $converted = $this->convertJalaliToGregorian($this->birth_date);
            if ($converted) {
                $this->merge(['birth_date' => $converted]);
            } else {
                $this->merge(['birth_date' => null]);
            }
        }
    }

    private function convertJalaliToGregorian(string $input): ?string
    {
        try {
            // Convert Persian numbers to English
            $english = strtr($input, [
                '۰'=>'0','۱'=>'1','۲'=>'2','۳'=>'3','۴'=>'4',
                '۵'=>'5','۶'=>'6','۷'=>'7','۸'=>'8','۹'=>'9',
                '٫' => '.', '٬' => ','
            ]);

            // Replace dashes with slashes just in case
            $normalized = str_replace('-', '/', $english);

            // Now parse and convert
            return Jalalian::fromFormat('Y/m/d', $normalized)->toCarbon()->toDateString();

        } catch (\Exception $e) {
            return null; // If conversion fails
        }
    }

    public function rules(): array
    {
        return [
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:8|confirmed',
            'father_name'     => 'nullable|string|max:255',
            'gender'          => 'required|in:مرد,زن,دیگر',
            'birth_date'      => 'required|string',
            'national_id'     => 'required|string|max:20',
            'phone_number'    => 'required|string|max:20',
            'emergency_phone' => 'required|string|max:20',
            'address_line'    => 'required|string|max:255',
            'city'            => 'required|string|max:255',
            'province'        => 'required|string|max:255',
            'postal_code'     => 'required|string|max:20',
            'marital_status'  => 'required|in:تنها,متاهل,جداشده,بیوه',
            'introducer'      => 'nullable|string|max:255',
            'profile_photo'   => 'nullable|image|max:2048',
        ];
    }
}
