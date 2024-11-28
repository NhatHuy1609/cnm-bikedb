<?php

namespace App\Utils;

use Illuminate\Validation\Rules\Password;

class Validation
{
    public static function validateLoginCredentials(array $data): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public static function validateRegisterCredentials(array $data): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:users',
                function ($attribute, $value, $fail) {
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!checkdnsrr($domain, 'MX')) {
                        $fail('This email domain does not exist or cannot receive emails.');
                    }
                }
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()       
                    ->numbers()         
                    ->symbols()         
                    ->uncompromised(),  
            ],
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên của bạn.',
            'name.string' => 'Họ tên chỉ được chứa chữ cái.',
            'name.max' => 'Họ tên không được vượt quá :max ký tự.',
            
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Email này đã được đăng ký.',
            'email.dns' => 'Tên miền email không tồn tại.',
            
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.mixed' => 'Mật khẩu phải chứa ít nhất một chữ hoa và một chữ thường.',
            'password.numbers' => 'Mật khẩu phải chứa ít nhất một số.',
            'password.symbols' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt.',
            'password.uncompromised' => 'Mật khẩu này đã bị lộ trong một vụ rò rỉ dữ liệu. Vui lòng chọn mật khẩu khác.',
        ];
    }

    public static function attributes(): array
    {
        return [
            'name' => 'họ và tên',
            'email' => 'địa chỉ email', 
            'password' => 'mật khẩu',
            'password_confirmation' => 'xác nhận mật khẩu'
        ];
    }

    public static function loginMessages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'auth.failed' => 'Tài khoản không tồn tại.',
        ];
    }
}