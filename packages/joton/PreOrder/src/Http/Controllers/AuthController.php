<?php

namespace Joton\PreOrder\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;
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
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $loginInfo = $this->authService->login($request->validated());
            $statusCode = $loginInfo->status_code;
            unset($loginInfo->status_code);

            return response()->json($loginInfo, $statusCode);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Logout a user and revoke authentication tokens.
     *
     * @param LogoutRequest $request
     * @return JsonResponse
     */
    public function logout(LogoutRequest $request): JsonResponse
    {
        try {
            $logoutInfo = $this->authService->logout();

            return response()->json($logoutInfo, 200);
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
