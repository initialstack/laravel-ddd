<?php declare(strict_types=1);

namespace App\Account\Presentation\Action;

use App\Shared\Presentation\Controller as Action;
use App\Account\Application\Profile\ProfileQuery;
use App\Account\Presentation\Responder\ProfileResponder;
use App\Shared\Domain\Bus\QueryBusInterface;
use App\Shared\Presentation\Response\ResourceResponse;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Middleware;
use Spatie\RouteAttributes\Attributes\Route;
use Illuminate\Http\Request;

#[Prefix(prefix: 'v1')]
#[Middleware(middleware: 'auth:api')]
final class ProfileAction extends Action
{
    /**
     * Formats and returns the profile response.
     *
     * @var ProfileResponder
     */
    private readonly ProfileResponder $responder;

    /**
     * Constructs a new ProfileAction instance.
     *
     * @param QueryBusInterface $queryBus
     */
    public function __construct(
        private readonly QueryBusInterface $queryBus
    ) {
        $this->responder = new ProfileResponder();
    }

    /**
     * Handles the profile retrieval HTTP GET request.
     *
     * @return ResourceResponse
     */
    #[Route(methods: 'GET', uri: '/profile')]
    public function __invoke(): ResourceResponse
    {
        /** @var \App\Account\Domain\User|null $user */
        $user = $this->queryBus->ask(
            query: new ProfileQuery()
        );

        return $this->responder->respond(
            result: $user
        );
    }
}
