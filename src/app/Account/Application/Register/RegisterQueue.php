<?php declare(strict_types=1);

namespace App\Account\Application\Register;

use App\Shared\Application\Queue\Queue;
use App\Shared\Domain\Slug\RoleSlug;
use App\Account\Domain\User;
use App\Account\Domain\Repository\RoleRepositoryInterface;
use App\Account\Domain\Repository\UserRepositoryInterface;
use App\Account\Domain\Email\Email;
use App\Account\Domain\Password\Password;

final class RegisterQueue extends Queue
{
    /**
     * Create a new registration job instance.
     *
     * @param RegisterCommand $command
     */
    public function __construct(
        private RegisterCommand $command
    ) {}

    /**
     * Registers a new user with the "user" role.
     *
     * @param RoleRepositoryInterface $roleRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function handle(
        RoleRepositoryInterface $roleRepository,
        UserRepositoryInterface $userRepository): void
    {
        $role = $roleRepository->findBySlug(
            slug: RoleSlug::fromString(value: 'user')
        );

        if (is_null(value: $role)) {
            throw new \RuntimeException(
                message: 'Role "user" not found.'
            );
        }

        $user = new User(
            name: $this->command->name,
            email: Email::fromString(
                value: $this->command->email
            ),
            password: Password::fromPlain(
                value: $this->command->password
            ),
        );

        $user->addRole(role: $role);
        $userRepository->save(user: $user);
    }
}
