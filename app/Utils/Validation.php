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
            'name.required' => 'Please enter your full name.',
            'name.string' => 'Name must be text only.',
            'name.max' => 'Name cannot exceed :max characters.',
            
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'email.dns' => 'This email domain does not exist.',
            
            'password.required' => 'Please enter a password.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.mixed' => 'Password must contain at least one uppercase and one lowercase letter.',
            'password.numbers' => 'Password must contain at least one number.',
            'password.symbols' => 'Password must contain at least one special character.',
            'password.uncompromised' => 'This password has appeared in a data leak. Please choose a different password.',
        ];
    }

    public static function attributes(): array
    {
        return [
            'name' => 'full name',
            'email' => 'email address',
            'password' => 'password',
            'password_confirmation' => 'password confirmation'
        ];
    }

    public static function loginMessages(): array
    {
        return [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
            'auth.failed' => 'Account not found.',
        ];
    }
}