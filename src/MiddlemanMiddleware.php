<?php

namespace Interop\Http\Message\Strategies\Examples\Middleman;

use Interop\Http\Message\Strategies\ServerRequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class MiddlemanMiddleware implements ServerRequestHandlerInterface
{
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
        $response = new Response();
        $response->getBody()->write("Hello $name!");

        return $response->withHeader('X-Powered-By', 'Unicorns');
    }
}
