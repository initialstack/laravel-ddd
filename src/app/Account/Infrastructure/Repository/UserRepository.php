<?php declare(strict_types=1);

namespace App\Account\Infrastructure\Repository;

use App\Account\Domain\User;
use App\Account\Domain\Email\Email;
use App\Account\Domain\Repository\UserReadRepositoryInterface;
use App\Account\Domain\Repository\UserWriteRepositoryInterface;
use App\Account\Domain\Repository\UserRepositoryInterface;
use App\Shared\Domain\Id\UserId;

final class UserRepository implements UserRepositoryInterface
{
    /**
     * Injects repositories for reading and writing User entities.
     *
     * @param UserReadRepositoryInterface $readRepository
     * @param UserWriteRepositoryInterface $writeRepository
     */
    public function __construct(
        private UserReadRepositoryInterface $readRepository,
        private UserWriteRepositoryInterface $writeRepository
    ) {}

    /**
     * Find a User entity by its unique identifier.
     *
     * @param UserId $id
     * @return User|null
     */
    public function findById(UserId $id): ?User
    {
        return $this->readRepository->findById(id: $id);
    }

    /**
     * Find a User entity by its email address.
     *
     * @param Email $email
     * @return User|null
     */
    public function findByEmail(Email $email): ?User
    {
        return $this->readRepository->findByEmail(email: $email);
    }

    /**
     * Find a User entity by its unique identifier and token.
     *
     * @param UserId $id
     * @param string $token
     * 
     * @return User|null
     */
    public function findByToken(UserId $id, string $token): ?User
    {
        return $this->readRepository->findByToken(id: $id, token: $token);
    }

    /**
     * Save a User entity using transactional repository.
     *
     * @param User $user
     */
    public function save(User $user): void
    {
        $this->writeRepository->save(user: $user);
    }
}
