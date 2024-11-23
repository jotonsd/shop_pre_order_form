<?php

namespace Joton\PreOrder\Repositories;

use Exception;
use Throwable;
use App\Models\User;
use Joton\PreOrder\Repositories\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * Find a user by their email address.
     *
     * @param string $email
     * @return User|null
     */
    public function findUserByEmail(string $email): User
    {
        try {
            return User::where('email', $email)->first();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Create an authentication token for a user.
     *
     * @param User $user
     * @return string
     */
    public function createToken($user): string
    {
        try {
            return $user->createToken('auth_token')->plainTextToken;
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }

    /**
     * Revoke all authentication tokens for a user.
     *
     * @param User $user
     * @return void
     */
    public function revokeTokens($user): void
    {
        try {
            $user->tokens()->delete();
        } catch (Throwable $th) {
            throw new Exception($th);
        }
    }
}
