<?php

namespace Interop\Http\Message\Strategies\Examples\Middleman;

use Interop\Http\Factory\ResponseFactoryInterface;
use Interop\Http\Message\Strategies\ServerRequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MiddlemanMiddleware implements ServerRequestHandlerInterface
{
    protected $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Process a server request and return the produced response.
     *
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $name = $request->getAttribute('name');
        $response = $this->responseFactory->createResponse();
        $response->getBody()->write("Hello $name!");

        return $response->withHeader('X-Powered-By', 'Unicorns');
    }
}
