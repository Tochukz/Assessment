<?php
namespace App;

/**
 * This class will handle routing functionality
 */
class Route
{
    static $routes = [];

    /**
     * Maps url to controller-actions as defined in the routes file.
     * 
     * @return void
     */
    public static function mapRoute()
    {
        $uri = strtolower($_SERVER['REQUEST_URI']);
        $method = strtoupper($_SERVER['REQUEST_METHOD']);                                 
        $segments = explode("/", $uri);
        $routes = self::$routes;
        foreach($routes as $route){
            if($route->method == $method && $route->url == $uri){             
                $routeControllerAction = explode("@", $route->controllerAction);              ;
                $controller = $routeControllerAction[0];
                $action = $routeControllerAction[1];
                $controllerObj = new $controller();
                $controllerObj->$action();
            }
        }
        if($uri == '/' && $method == 'GET'){
            echo "Go to home page";            
        }   
    
    }


    /**
     * Adds a route for a GET method to the array of routes.
     * 
     * @param string $url
     * @param string $controllerAction
     * @return void
     */
    public static function get(string $url, string $controllerAction)
    {
        self::addRoute($url, $controllerAction, 'GET');
    }

    /**
     * Adds a route for a POST method to the array of routes.
     * 
     * @param string $url
     * @param string $controllerAction
     * @return void
     */
    public static function post(string $url, string $controllerAction)
    {
       self::addRoute($url, $controllerAction, 'POST');
    }

    /**
     * Adds a route for a POST or GET method to the array of routes.
     * 
     * @param string url
     * @param string $controllerAction
     * @param string $method
     * @return void
     */
    protected static function addRoute(string $url, string $controllerAction, string $method)
    {      
       $newRoute = new \stdClass();
       $newRoute->method = $method;
       $newRoute->url = strtolower($url); 
       $newRoute->controllerAction = "Controllers\\$controllerAction";
       array_push(self::$routes, $newRoute);
    }
}