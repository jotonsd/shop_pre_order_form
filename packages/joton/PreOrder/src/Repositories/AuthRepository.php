<?php

namespace Joton\PreOrder\Repositories;

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
    public function findUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * Create an authentication token for a user.
     *
     * @param User $user
     * @return string
     */
    public function createToken($user)
    {
        return $user->createToken('auth_token')->plainTextToken;
    }

    /**
     * Revoke all authentication tokens for a user.
     *
     * @param User $user
     * @return void
     */
    public function revokeTokens($user)
    {
        $user->tokens()->delete();
    }
}
