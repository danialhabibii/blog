<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginAction
{
    public function execute(array $data): string
    {
        $user = User::firstWhere('email', $data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'status' => ['Authentication failed!']
            ]);
        }
        return $user->createToken($user->name)->plainTextToken;
    }
}
