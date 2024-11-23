<?php

namespace Joton\PreOrder\Repositories;

interface AuthRepositoryInterface
{
    /**
     * Find a user by their email address.
     *
     * @param string $email
     * @return mixed
     */
    public function findUserByEmail(string $email);

    /**
     * Create an authentication token for a user.
     *
     * @param mixed $user
     * @return string
     */
    public function createToken($user);

    /**
     * Revoke all authentication tokens for a user.
     *
     * @param mixed $user
     * @return void
     */
    public function revokeTokens($user);
}
