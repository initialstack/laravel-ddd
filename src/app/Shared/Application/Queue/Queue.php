<?php declare(strict_types=1);

namespace App\Shared\Application\Queue;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

abstract class Queue implements ShouldQueue
{
    /**
     * A queued job for asynchronous processing.
     */
    use Queueable;
}
