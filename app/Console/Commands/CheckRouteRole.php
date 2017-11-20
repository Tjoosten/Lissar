<?php

namespace App\Console\Commands;

use Illuminate\Routing\Route;
use Illuminate\Foundation\Console\RouteListCommand; 

class CheckRouteRole extends RouteListCommand
{
    /**
     *  {@inheritDoc}
     */
    protected $name = 'route:check-role';

    /**
     * {@inheritDoc}
     */
    protected $description = 'Table of all routes that do not have a role.';

    /**
     * {@inheritDoc}
     */
    protected $headers = ['method', 'uri', 'name', 'controller', 'action', 'middleware'];

    /**
     * {@inheritDoc}
     */
    protected function getRouteInformation(Route $route)
    {
        $actions    = explode('@',$route->getActionName());
        $middleware = implode(',',$route->middleware());

        if(!strpos($middleware, 'role')) {
            return $this->filterRoute([
                'method'     => implode('|', $route->methods()),
                'uri'        => $route->uri(),
                'name'       => is_string($route->getName()) ? "<fg=green>{$route->getName()}</>" : "-",
                'controller' => isset($actions[0]) ? "<fg=cyan>{$actions[0]}</>" : "-",
                'action'     => isset($actions[1]) ? "<fg=red>{$actions[1]}</>" : "-",
                'middleware' => $middleware
            ]);
        }
    }
}
