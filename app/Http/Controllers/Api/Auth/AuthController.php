<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(UserLoginRequest $request)
    {
        return $this->userService->login($request);
    }

    public function refreshAccessToken(RefreshTokenRequest $request)
    {
        return $this->userService->refresh($request);
    }

    public function logout(Request $request)
    {
        return $this->userService->logout($request);
    }

    public function getCurrentUser()
    {
        $user = Auth::user();
        $needsToFill = QuestionnaireService::needsToFillQuestionnaire($user);
        $response = Arr::except((array)$user, ['password']);
        $response['needs_to_fill'] = $needsToFill;
        return response($response, 200);
    }


    public function register(UserRegisterRequest $request){
        if ($request['financial_report_year'] && now()->year - $request['financial_report_year'] > 2)
            return response(['message'=> 'financial-report-year-invalid'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        return $this->userService->register($request);
    }


}
