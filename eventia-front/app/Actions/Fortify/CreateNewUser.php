<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email'],
            'password' => $this->passwordRules(),
            'tipo_usuario' => ['required', 'string', 'max:255'],
        ])->validate();

        return User::create([
            'nombre' => $input['nombre'],
            'email' => $input['email'],
            'password' => $input['password'],
            'tipo_usuario' => $input['tipo_usuario']
            //la fecha de registro se pondrá automaticamente porque 
            // se lo hemos especificado en el modelo User.php
        ]);
    }
}
