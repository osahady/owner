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
        //https://regexr.com/6098t
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users', 'regex:/^((\+|[0][0])([1-9](\d{1,2})?)\s?)?[0]?((([5][3]\d)\s?(\d{3})\s?(\d{2})\s?(\d{2}))|(([9]\d{2})\s?(\d{3})\s?(\d{3}))|(([6]\d{2})\s?(\d{3})\s?(\d{3}))|(([6]\d{2})\s?(\d{6}))|((\d{4})\s?(\d{6}))|((\d{4})\s?(\d{4}))|((\d{3})\s?(\d{3})\s?(\d{4}))|((\d{2})\s?(\d{3})\s?(\d{4}))|((\d{3})\s?(\d{4})\s?(\d{4}))|(([4][0])\s?(\d{3})\s?(\d{2})\s?(\d{2}))|(([7]\d{1})\s?(\d{3})\s?(\d{2})\s?(\d{2})))$/u'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
