<?php
/**
 * @description: Core App Class
 * @author: Quentin Thomasset
 * @package: Blogpro
 */

namespace App\Model;
use Symfony\Component\Yaml\Yaml;

class Application {
    protected $request;
    protected $response;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    /**
     * function getController, used to run the correct controller
     */
    public function getController()
    {
        $router = new Router;

        $routes = Yaml::parse(file_get_contents(__DIR__ . '/../Config/routes.yml'));

        // We read every routes
        foreach ($routes as $route)
        {
            $vars = [''];

            // We check if there are variables in the URL.
            if (isset($route['vars']) && $route['vars'])
            {
                $vars = explode(',', $route['vars']);
            }

            // We add the route in the router
            $router->addRoute(new Route($route['url'], $route['module'], $route['action'], $vars));
        }

        try
        {
            //We retrieve the route matching the URL
            $matchedRoute = $router->getRoute($this->request->requestURI());
        }
        catch (MissingRouteException $e)
        {
            if ($e->getCode() == Router::NO_ROUTE)
            {
                // If no route matches, run 404 error function
                $this->response->redirect404();
                die;
            }
        }

        // Run the controller instance and the action of the route

        $controllerClass = 'App\\Controller\\Controller' .$matchedRoute->module();
        if ($matchedRoute->hasVars())
        {
            (new $controllerClass($router, $this->request, $matchedRoute->vars()))->execute($matchedRoute->action());
        }
        else
        {
            (new $controllerClass($router, $this->request))->execute($matchedRoute->action());
        }
    }

    public function run()
    {
        return $this->getController();
    }

}