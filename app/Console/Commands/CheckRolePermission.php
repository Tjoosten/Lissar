<?php

namespace App\Console\Commands;

use Illuminate\Routing\Route;
use Illuminate\Foundation\Console\RouteListCommand;

class CheckRolePermission extends RouteListCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'route:check-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Table of all routes that do not have a permission';

    /**
     * The header data for the routes table. 
     * 
     * @return array
     */
    protected $headers = ['method', 'url', 'name', 'controller', 'action', 'middleware'];

    /**
     * get the information about the route.
     *
     * @param  Route $route The route instance.
     * @return mixed
     */
    protected function getRouteInformation(Route $route)
    {
        $actions    = explode('@', $route->getActionName()); 
        $middleware = implode(',',$route->middleware());

        if (! strpos($middleware, 'permission')) {
            return $this->filterRoute([
                'method'        => implode('|', $route->methods()), 
                'uri'           => $route->uri(), 
                'name'          => is_string($route->getName()) ? "<fg=green>{$route->getName()}</>" : "-",
                'controller'    => isset($actions[0]) ? "<fg=cyan>{$actions[0]}</>" : "-",
                'action'        => isset($actions[1]) ? "<fg=red>{$actions[1]}</>" : "-",
                'middleware'    => $middleware
            ]);
        }
    }
}
