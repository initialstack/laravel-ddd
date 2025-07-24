<?php declare(strict_types=1);

namespace App\Shared\Application;

use Illuminate\Pipeline\Pipeline;

abstract class Process
{
    /**
     * An array of pipes to be executed in the pipeline.
     *
     * @var array<int, string|callable|object>
     */
    protected array $pipes = [];

    /**
     * Runs the pipeline with the given request.
     *
     * @param object $passable
     * @return mixed
     */
    public function run(object $passable): mixed
    {
        return app(
            abstract: Pipeline::class
        )->send(
            passable: $passable
        )->through(
            pipes: $this->pipes
        )->thenReturn();
    }
}
