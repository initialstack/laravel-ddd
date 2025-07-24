<?php declare(strict_types=1);

namespace App\Account\Infrastructure\Dispatching;

use Illuminate\Support\ServiceProvider;
use App\Account\Application\Register\RegisterCommand;
use App\Account\Application\Register\RegisterHandler;
use App\Account\Application\Login\LoginCommand;
use App\Account\Application\Login\LoginHandler;
use App\Shared\Domain\Bus\CommandBusInterface;

final class CommandDispatcher extends ServiceProvider
{
    /**
     * Mapping of commands to their handlers.
     * 
     * @var array<class-string, class-string>
     */
    private array $commands = [
        RegisterCommand::class => RegisterHandler::class,
        LoginCommand::class => LoginHandler::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(CommandBusInterface $commandBus): void
    {
        $commandBus->register(map: $this->commands);
    }
}
