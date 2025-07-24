<?php declare(strict_types=1);

namespace App\Account\Infrastructure\Repository\Transaction;

use App\Account\Domain\User;
use App\Account\Domain\Repository\UserWriteRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

final class UserTransactionRepository implements UserWriteRepositoryInterface
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
     * Saves a User entity inside a transaction.
     *
     * @param User $user
     * @throws \RuntimeException
     */
    public function save(User $user): void
    {
        try {
            DB::transaction(
                callback: function () use ($user): void {
                    try {
                        $this->entityManager->persist(object: $user);
                        $this->entityManager->flush();
                    }

                    catch (ORMException $e) {
                        throw new \RuntimeException(
                            message: "Failed to save user: {$e->getMessage()}",
                            code: (int) $e->getCode(),
                            previous: $e
                        );
                    }
                },
                attempts: 3
            );
        }

        catch (QueryException $e) {
            throw new \RuntimeException(
                message: 'Error saving user: ' . $e->getMessage(),
                code: (int) $e->getCode(),
                previous: $e
            );
        }
    }
}
