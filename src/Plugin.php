<?php

namespace Rest;

use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\RoutingMiddleware;
use Rest\Middleware\AuthorizationMiddleware;
use Rest\Middleware\RestErrorMiddleware;
use Rest\Middleware\RestMiddleware;

/**
 * Plugin for Rest
 */
class Plugin extends BasePlugin
{
    /**
     * @param MiddlewareQueue $middlewareQueue cakephp middleware queue
     * @return MiddlewareQueue
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue->insertAfter(
            RoutingMiddleware::class,
            new RestMiddleware()
        );

        $middlewareQueue->insertAfter(
            RestMiddleware::class,
            new RestErrorMiddleware()
        );

        $middlewareQueue->insertAfter(
            RestErrorMiddleware::class,
            new AuthorizationMiddleware()
        );

        return $middlewareQueue;
    }
}
