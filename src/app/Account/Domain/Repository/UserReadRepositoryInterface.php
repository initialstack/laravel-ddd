<?php declare(strict_types=1);

namespace App\Account\Domain\Repository;

use App\Shared\Domain\Id\UserId;
use App\Account\Domain\User;
use App\Account\Domain\Email\Email;

interface UserReadRepositoryInterface
{
    /**
     * Find a User entity by its unique identifier.
     *
     * @param UserId $id
     * @return User|null
     */
    public function findById(UserId $id): ?User;

    /**
     * Find a User entity by its email address.
     *
     * @param Email $email
     * @return User|null
     */
    public function findByEmail(Email $email): ?User;

    /**
     * Find a User entity by its unique identifier and token.
     *
     * @param UserId $id
     * @param string $token
     * 
     * @return User|null
     */
    public function findByToken(UserId $id, string $token): ?User;
}
