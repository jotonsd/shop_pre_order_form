<?php

namespace Joton\PreOrder\Http\Controllers;

use Joton\PreOrder\Services\AuthService;
use Joton\PreOrder\Http\Requests\Auth\LoginRequest;
use Joton\PreOrder\Http\Requests\Auth\LogoutRequest;

class AuthController extends Controller
{
    protected $authService;

    /**
     * Constructor
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login a user and generate an authentication token.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        // Delegate login logic to the service
        $loginInfo = $this->authService->login($request->validated());
        $statusCode = $loginInfo->status_code;
        unset($loginInfo->status_code);

        return response()->json($loginInfo, $statusCode);
    }

    /**
     * Logout a user and revoke authentication tokens.
     *
     * @param LogoutRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(LogoutRequest $request)
    {
        // Delegate logout logic to the service
        $logoutInfo = $this->authService->logout();

        return response()->json($logoutInfo, 200);
    }
}
