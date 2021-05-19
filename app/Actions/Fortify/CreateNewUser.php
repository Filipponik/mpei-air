<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Carbon\Carbon;

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
            'sex' => ['required', 'string'],
            'birth_date' => ['required', 'string'],
            'login' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $person = Person::create([
            'fam' => $input['fam'],
            'im' => $input['im'],
            'otch' => $input['otch'],
            'sex' => $input['sex'],
            'birth_date' => (new Carbon($input['birth_date']))->toDateTimeString(),
        ]);

        $createdUser = User::create([
            'login' => $input['login'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'person_id' => $person->id,
        ]);

        $permissions = [
            'account',
            'addresses',
            'balances',
            'batch',
            'conditionalOrders',
            'deposits',
            'executions',
            'orders',
            'transfers',
            'withdrawals',
        ];

        $token = $createdUser->createToken('', $permissions)->plainTextToken;
        $createdUser->defaultToken = $token;
        $createdUser->save();

        return $createdUser;
    }
}
