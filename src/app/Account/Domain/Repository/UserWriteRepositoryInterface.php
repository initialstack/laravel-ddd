<?php declare(strict_types=1);

namespace App\Account\Domain\Repository;

use App\Account\Domain\User;

interface UserWriteRepositoryInterface
{
	/**
     * Save the given User entity.
     *
     * @param User $user
     */
	public function save(User $user): void;
}
