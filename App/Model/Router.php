<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 04/10/2017
 * Time: 16:42
 */
namespace App\Model;


class Router
{
    protected $routes = [];

    const NO_ROUTE = 1;

    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->routes))
        {
            $this->routes[] = $route;
        }
    }

    public function getRoute($url)
    {
        foreach ($this->routes as $route)
        {
            // If the route match the URL
            if (($varsValues = $route->match($url)) !== false)
            {
                // If it has variables
                if ($route->hasVars())
                {
                    $varsNames = $route->varsNames();
                    $listVars = [];

                    // We create a new table (key = variable name, value = its value)
                    foreach ($varsValues as $key => $match)
                    {
                        // The first value contain all the string captured
                        if ($key !== 0)
                        {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }

                    // We assign this variables tab to the route
                    $route->setVars($listVars);
                }

                return $route;
            }
        }
        throw new MissingRouteException('No route matches the URL.', self::NO_ROUTE);
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}