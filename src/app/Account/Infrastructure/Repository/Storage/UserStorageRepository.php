<?php declare(strict_types=1);

namespace App\Account\Infrastructure\Repository\Storage;

use App\Account\Domain\User;
use App\Account\Domain\Email\Email;
use App\Account\Domain\Repository\UserReadRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use App\Shared\Domain\Id\UserId;

final class UserStorageRepository implements UserReadRepositoryInterface
{
    /**
     * Doctrine EntityManager instance for DB operations.
     * 
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    /**
     * Find a User entity by its unique identifier.
     *
     * @param UserId $id
     * @return User|null
     */
    public function findById(UserId $id): ?User
    {
        return $this->entityManager->getRepository(
            className: User::class
        )->find(
            id: $id
        );
    }

    /**
     * Find a User entity by its email address.
     *
     * @param Email $email
     * @return User|null
     */
    public function findByEmail(Email $email): ?User
    {
        return $this->entityManager->getRepository(
            className: User::class
        )->findOneBy(
            criteria: ['email.email' => $email]
        );
    }

    /**
     * Find a User entity by its unique identifier and remember token.
     *
     * @param UserId $id
     * @param string $token
     * 
     * @return User|null
     */
    public function findByToken(UserId $id, string $token): ?User
    {
        return $this->entityManager->getRepository(
            className: User::class
        )->findOneBy(
            criteria: [
                'remember_token' => $token,
                'id' => $id,
            ]
        );
    }
}
