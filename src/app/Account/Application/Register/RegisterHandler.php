<?php declare(strict_types=1);

namespace App\Account\Application\Register;

use App\Shared\Application\Handler;
use Illuminate\Support\Facades\Log;

final class RegisterHandler extends Handler
{
    /**
     * Handle the registration command.
     *
     * @param RegisterCommand $command
     * @return bool
     */
    public function handle(RegisterCommand $command): bool
    {
        try {
            RegisterQueue::dispatch($command);

            return true;
        }

        catch (\Throwable $e) {
            Log::error(
                message: 'Register error: ' . $e->getMessage(),
                context: ['exception' => $e]
            );

            return false;
        }
    }
}
