<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RegistrationAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\Auth\AuthTokenResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request, RegistrationAction $registrationAction)
    {
        $registrationAction->execute($request->validated());
        return Response::success('User Successfully registered.', 201);
    }

    public function login(LoginRequest $request, LoginAction $loginAction)
    {
        try {
            $token = $loginAction->execute($request->validated());
        } catch (\Exception $e) {
            return Response::error($e->getMessage(), 403);
        }
        return AuthTokenResource::make($token);
    }
}
