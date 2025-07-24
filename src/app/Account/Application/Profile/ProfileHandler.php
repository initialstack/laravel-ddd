<?php declare(strict_types=1);

namespace App\Account\Application\Profile;

use App\Shared\Application\Handler;
use App\Shared\Domain\Id\UserId;
use App\Account\Domain\Repository\UserRepositoryInterface;
use App\Account\Domain\User;

final class ProfileHandler extends Handler
{
    /**
     * Constructs a new ProfileHandler instance.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(
        private UserRepositoryInterface $repository
    ) {}

    /**
     * Handles ProfileQuery to retrieve a User by ID.
     *
     * @param ProfileQuery $query
     * @return User|null
     */
    public function handle(ProfileQuery $query): ?User
    {
        return $this->repository->findById(
            id: $query->userId
        );
    }
}
