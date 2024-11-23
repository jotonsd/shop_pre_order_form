<?php

namespace Joton\PreOrder\Services;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Auth;
use Joton\PreOrder\Repositories\AuthRepositoryInterface;
use stdClass;

class AuthService
{
    protected $authRepository;

    /**
     * Constructor
     *
     * @param AuthRepositoryInterface $authRepository
     */
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Handle user login and token generation.
     *
     * @param array $credentials
     * @return stdClass
     */
    public function login(array $credentials): stdClass
    {
        try {
            // Attempt to authenticate the user
            if (!Auth::attempt($credentials)) {
                return (object) [
                    'message' => "Invalid login credentials!",
                    'status_code' => 401
                ];
            }

            // Retrieve the authenticated user
            $user = Auth::user();

            // Generate and return the token
            $token = $this->authRepository->createToken($user);

            return (object) [
                'status_code' => 200,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ];
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Handle user logout and token revocation.
     *
     * @return stdClass
     */
    public function logout(): stdClass
    {
        try {
            $user = Auth::user();

            $this->authRepository->revokeTokens($user);

            return (object) ['message' => 'Logged out successfully'];
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
