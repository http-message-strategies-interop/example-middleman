<?php

namespace Interop\Http\Message\Strategies\Examples\Middleman;

use Interop\Http\Message\Strategies\Examples\Middleman\Helpers\ResponseFactory;
use Interop\Http\Message\Strategies\ServerRequestHandlerInterface;
use mindplay\middleman\Dispatcher;
use Zend\Diactoros\ServerRequest;

class MiddlemanMiddlewareTest extends \PHPUnit\Framework\TestCase
{
    public function dispatcherFactory($middleware)
    {
        return new Dispatcher([
            $middleware,
            new ResponseFactory(),
        ]);
    }

    public function testMiddlemanMiddlewareShouldImplementsServerRequestHandlerInterface()
    {
        $this->assertInstanceOf(
            ServerRequestHandlerInterface::class,
            new MiddlemanMiddleware(new ResponseFactory())
        );
    }

    public function testMiddlemanMiddlewareShouldSayHello()
    {
        $dispatcher = $this->dispatcherFactory(new MiddlemanMiddleware(new ResponseFactory()));
        $request = (new ServerRequest())->withAttribute('name', 'world');

        $this->assertEquals('Hello world!', ''.$dispatcher->dispatch($request)->getBody());
    }

    public function testMiddlemanMiddlewareShouldBePoweredByUnicorns()
    {
        $dispatcher = $this->dispatcherFactory(new MiddlemanMiddleware(new ResponseFactory()));
        $request = (new ServerRequest())->withAttribute('name', 'world');

        $this->assertEquals(['Unicorns'], $dispatcher->dispatch($request)->getHeader('X-Powered-By'));
    }
}
