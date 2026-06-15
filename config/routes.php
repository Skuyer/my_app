<?php
declare(strict_types=1);

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {

    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {

        $builder->connect('/', [
            'controller' => 'Pages',
            'action' => 'display',
            'home',
        ]);

        $builder->connect('/pages/*', [
            'controller' => 'Pages',
            'action' => 'display',
        ]);

        $builder->connect('/login', [
            'controller' => 'Users',
            'action' => 'login',
        ]);

        $builder->connect('/logout', [
            'controller' => 'Users',
            'action' => 'logout',
        ]);

        $builder->scope('/articles', function (RouteBuilder $builder): void {
            $builder->connect('/tagged/*', [
                'controller' => 'Articles',
                'action' => 'tags',
            ]);
        });

        $builder->fallbacks();
    });
};