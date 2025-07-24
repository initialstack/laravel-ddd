<?php declare(strict_types=1);

namespace App\Account\Infrastructure\Dispatching;

use Illuminate\Support\ServiceProvider;
use App\Account\Application\Profile\ProfileQuery;
use App\Account\Application\Profile\ProfileHandler;
use App\Account\Application\Logout\LogoutQuery;
use App\Account\Application\Logout\LogoutHandler;
use App\Shared\Domain\Bus\QueryBusInterface;

final class QueryDispatcher extends ServiceProvider
{
    /**
     * Mapping of commands to their handlers.
     * 
     * @var array<class-string, class-string>
     */
    private array $queries = [
        ProfileQuery::class => ProfileHandler::class,
        LogoutQuery::class => LogoutHandler::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(QueryBusInterface $queryBus): void
    {
        $queryBus->register(map: $this->queries);
    }
}
