<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $phoneRegex = require_once __DIR__ . '../../../Constants/phone_regex.php';
        //https://regexr.com/6098t
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users', 'regex:/' . $phoneRegex . '/u'],
            'code' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $code = $this->generateCode($input['phone']);
        if ($code == $input['code']) {

            return User::create([
                'name' => $input['name'],
                'phone' => $input['phone'],
                // 'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
        } else {
            return response()->json([
                'message' => 'account can not be created'
            ], 422);
        }
    }

    private function generateCode($phone)
    {
        $phoneDigits = str_split(trim($phone, '+'));
        $total = 0;
        foreach ($phoneDigits as $digit) {
            $total += $digit;
        }
        return pow($total, 2);
    }
}
