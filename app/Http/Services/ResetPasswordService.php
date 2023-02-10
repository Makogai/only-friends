<?php

namespace App\Http\Services;

use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SetNewPasswordRequest;
use App\Mail\ResetPasswordMail;
use App\Models\EmailToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class ResetPasswordService
{
    public function resetPassword(ResetPasswordRequest $request)
    {
        $request->validated();
        $user = User::query()->where('email', $request['email'])->first();
        $value = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 32);
        EmailToken::query()->create(['user_id' => $user->id, 'token' => $value]);
        $link = config('app.front_url')."/new-password?token=" . $value;
        Mail::to($user)->send(new ResetPasswordMail($link));
        return response('OK', ResponseAlias::HTTP_OK);
    }

    public function setNewPassword(SetNewPasswordRequest $request)
    {
        $request->validated();
        if (!$request->has('token')) {
            return response(['message' => 'missing-token'], ResponseAlias::HTTP_FORBIDDEN);
        }
        $token = $request['token'];
        //        $database_token = PersonalAccessToken::query()->where('token', $token)->first();
        $database_token = EmailToken::query()->where('token', $request->token)->first();

        if ($database_token) {
            //            $user = User::query()->find($database_token->tokenable_id);
            $user = $database_token->user;
            $user->update(['password' => Hash::make($request['new_password'])]);
            $database_token->delete();
            return response($user->email, ResponseAlias::HTTP_OK);
        } else {
            return response(['message' => 'invalid-token'], ResponseAlias::HTTP_FORBIDDEN);
        }

    }
}
