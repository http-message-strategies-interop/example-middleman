<?php

namespace Interop\Http\Message\Strategies\Examples\Middleman\Helpers;

use Zend\Diactoros\Response;

class ResponseFactory implements \Interop\Http\Factory\ResponseFactoryInterface
{
    /**
     * Create a new response.
     *
     * @param int $code HTTP status code
     *
     * @return ResponseInterface
     */
    public function createResponse($code = 200)
    {
        return new Response('php://memory', $code);
    }

    /**
     * Create a new response.
     *
     * @param int $code HTTP status code
     *
     * @return ResponseInterface
     */
    public function __invoke($code = 200)
    {
        return $this->createResponse($code);
    }
}
