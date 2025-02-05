<?php

declare(strict_types=1);

namespace Hyperf\Dispatcher;

use Hyperf\Context\Context;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use SwooleTW\Hyperf\Dispatcher\Pipeline;

class HttpRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        protected array $middlewares,
        protected $coreMiddleware,
        protected ContainerInterface $container
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        Context::set('request.middleware', $this->middlewares);

        return $this->container
            ->get(Pipeline::class)
            ->send($request)
            ->through([...$this->middlewares, $this->coreMiddleware])
            ->thenReturn();
    }
}
