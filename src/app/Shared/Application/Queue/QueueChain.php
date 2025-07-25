<?php declare(strict_types=1);

namespace App\Shared\Application\Queue;

use Illuminate\Support\Facades\Bus;

abstract class QueueChain
{
    /**
     * Array of queues to run in sequence.
     *
     * @var array<int, object|string|callable>
     */
    protected array $queues = [];

    /**
     * Run the chain of podcast queues.
     *
     * @return mixed
     */
    public function run(): mixed
    {
        return Bus::chain($this->queues)->dispatch();
    }
}
