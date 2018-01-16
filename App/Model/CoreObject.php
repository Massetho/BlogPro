<?php
/**
 * Created by PhpStorm.
 * User: quent
 * Date: 05/12/2017
 * Time: 10:12
 */

namespace App\Model;
abstract class CoreObject
{
    public function getUrl($controller, $action ='index', $vars = [])
    {
        // TODO : implement this function to get URL from blocks or controllers
        $routes = $controller->getRouter()->getRoutes();
        //$routes = $router->getRoutes();
        foreach ($routes as $route)
        {
<<<<<<< Updated upstream
            $name=$controller->getControllerName();
            $module = $route->module();
            $action2=$route->action();
=======
            $name =$controller->getControllerName();
            $module = $route->module();
            $action =$route->action();
>>>>>>> Stashed changes

            if ($route->module() === $name && $route->action() === $action)
            {

                $url = $route->url();
                if (!empty($vars))
                {
                    /*
                    $url = '/article-(.+)-([0-9]+).html';
                    $title = "titredelarticle";
                    $id = 15687; */
                    $tempUrl = preg_replace('#\(.+\)#U', '%s', $url);

                    array_unshift($vars, $tempUrl);
                    //$args = array($tempUrl, $vars, '32254');
                    $url = call_user_func_array('sprintf', $vars);

                }
                return $url;
            }
        }
    }
}