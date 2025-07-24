<?php declare(strict_types=1);

namespace App\Account\Domain\Repository;

use App\Shared\Domain\Repository\AccountRepositoryInterface;
use App\Account\Domain\User;

interface UserRepositoryInterface extends
    UserReadRepositoryInterface,
    UserWriteRepositoryInterface,
    AccountRepositoryInterface {}
