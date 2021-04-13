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
        Validator::make($input, [
            'fam' => ['required', 'string', 'max:255'],
            'im' => ['required', 'string', 'max:255'],
            'otch' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'fam' => $input['fam'],
            'im' => $input['im'],
            'otch' => $input['otch'],
            'login' => $input['login'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
