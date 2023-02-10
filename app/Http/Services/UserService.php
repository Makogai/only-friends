<?php

namespace App\Http\Services;

use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserService
{
    public function login(UserLoginRequest $request): \Illuminate\Http\Response|Application|ResponseFactory
    {
        $user = $this->checkCredentials($request);
        if (!$user) {
            return response(
                [
                'message' => 'invalid-credentials'
                ], Response::HTTP_UNAUTHORIZED
            );
        }
        $access_token = $user->createToken('access_token')->plainTextToken;
        $refresh_token = $this->setRefreshToken($user);
        $response = [
            'message' => 'successful-login',
            'data' => [
                'user' => $user,
                'access_token' => $access_token,
                'refresh_token' => $refresh_token
            ]
        ];
        return response($response, Response::HTTP_OK);
    }

    public function refresh(RefreshTokenRequest $request)
    {
        try {
            $access_token = $this->refreshAccessToken($request->validated());
            $response = [
                'message' => 'successful-token-refresh',
                'data' => [
                    'access_token' => $access_token,
                    'refresh-token' => $request['refresh_token']
                ]
            ];
            return response($response, Response::HTTP_OK);
        }catch (Throwable $e){
            return response(['message' => 'invalid-token'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        auth()->user()->update(['remember_token' => null]);
        $response = [
            'message' => 'successful-logout',
        ];
        return response($response, Response::HTTP_OK);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        if (!Hash::check($data['old_password'], Auth::user()->password)) {
            return response(['message' => 'invalid-password'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        User::where('id', Auth::user()->id)
            ->update(['password' => Hash::make($data['new_password'])]);

        return response(['message' => 'successful-password-change'], Response::HTTP_OK);
    }

    public function checkCredentials($request): ?User
    {
        $user = User::query()->where('email', $request['email'])->first();
        if (!$user || !Hash::check($request['password'], $user->password)) {
            return null;
        }
        return $user;

    }

    public function setRefreshToken(User $user)
    {
        $refresh_token = $user->createToken('remember_token')->plainTextToken;
        $user->update(['remember_token' => $refresh_token]);
        return $refresh_token;
    }

    public function refreshAccessToken($request)
    {
        $user = User::query()->where('remember_token', $request['refresh_token'])->first();
        $user->currentAccessToken();
        $user->tokens()->delete();
        return $user->createToken('access_token')->plainTextToken;
    }

    public function register($request, $update = false){
        $fields = $request->validated();
        if (!$update) {
            $user = $this->createUser($fields);
        }
        else{
            $user = $this->updateUser($fields, $request);
        }

        return response(Arr::except($user, ['password']), 200);
    }

    public function createUser($fields){
        $fields['password'] = Hash::make($fields['password']);
        return User::query()->create($fields);
    }

}
