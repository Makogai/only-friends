<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SetNewPasswordRequest;
use App\Http\Services\ResetPasswordService;
use App\Models\User;

class ResetPasswordController extends Controller
{
    protected ResetPasswordService $resetPasswordService;

    public function __construct()
    {
        $this->resetPasswordService = new ResetPasswordService();
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = User::query()->where('email', $request['email'])->first();
        return $this->resetPasswordService->resetPassword($request);
    }

    public function setNewPassword(SetNewPasswordRequest $request)
    {
        return $this->resetPasswordService->setNewPassword($request);
    }
}
