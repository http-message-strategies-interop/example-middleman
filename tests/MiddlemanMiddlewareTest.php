<?php

namespace Interop\Http\Message\Strategies\Examples\Middleman;

use Interop\Http\Message\Strategies\ServerRequestResponseInterface;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response;
use mindplay\middleman\Dispatcher;

class MiddlemanMiddlewareTest extends \PHPUnit\Framework\TestCase
{
    public function dispatcherFactory($middleware)
    {
        return new Dispatcher([
            $middleware,
            function () {
                return new Response();
            },
        ]);
    }

    public function testMiddlemanMiddlewareShouldImplementsServerRequestResponseInterface()
    {
        $this->assertInstanceOf(ServerRequestResponseInterface::class, new MiddlemanMiddleware());
    }

    public function testMiddlemanMiddlewareShouldSayHello()
    {
        $dispatcher = $this->dispatcherFactory(new MiddlemanMiddleware());
        $request = (new ServerRequest())->withAttribute('name', 'world');

        $this->assertEquals('Hello world!', ''.$dispatcher->dispatch($request)->getBody());
    }

    public function testMiddlemanMiddlewareShouldBePoweredByUnicorns()
    {
        $dispatcher = $this->dispatcherFactory(new MiddlemanMiddleware());
        $request = (new ServerRequest())->withAttribute('name', 'world');

        $this->assertEquals(['Unicorns'], $dispatcher->dispatch($request)->getHeader('X-Powered-By'));
    }
}
