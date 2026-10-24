<?php

namespace App\Core;

use App\Controllers\HomeController;

class Router
{
    //array on es desen les routes de l'aplicació
    private array $routes = [];

    //Funcions per dear rutes segons el mètode HTTP: get, put, post i delete

    public function get(string $path, array $action)
    {
        $this->add('GET', $path, $action);
    }

    public function post(string $path, array $action)
    {
        $this->add('POST', $path, $action);
    }

    public function put(string $path, array $action)
    {
        $this->add('PUT', $path, $action);
    }

    public function delete(string $path, array $action)
    {
        $this->add('DELETE', $path, $action);
    }

    //Funció per afegir rutes al fitxer de rutes
    private function add(string $method, string $path, array $action)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'action' => $action,
        ];
    }

    //Funció que crida als controllers i metpdes amb els parametres corresponents
    public function dispatch(string $method, string $url)
    {
        foreach ($this->routes as $route) {
            //El foreach recorre totes les rutes
            if ($route['method'] !== $method) {
                continue;
            }
            //Aquest codi només s'executa quan el mètode http de la $url es igual que 
            //el metode de la ruta que estem revisant de l'array de rutes

            //$params es false si la rutes no són igual o retorna 
            //els parametres si les rutes coinicdeixen
            $params = $this->match($route['path'], $url);

            //Quan es troba coincidencia de rutes entrem a dins el if
            //Es crea un objecte del controller (new $controllerClass), es crida al 
            //mètode $controllerMethod i es passen els paramtres $params
            if ($params !== false) {
                [$controllerClass, $controllerMethod] = $route['action'];

                $controller = new $controllerClass();

                // Els paràmetres extrets de la URL s'envien al mètode del controlador.
                $controller->$controllerMethod(...$params);
                return;
            }
        }

        //Si després de repassar l'array de routes no troba cap coincidència mostrem 
        //Error 404 pàgina no trobada
        http_response_code(404);
        $hc = new HomeController;
        $hc->notFound();
        
    }

    private function match(string $routePath, string $url)
    {
        // Convertim /products/{id} en una expressió regular per capturar la ruta i els parametres
        // Cada {parametre} captura una part de la URL que no contingui '/'.
        //Per exemple,
        $pattern = preg_replace('/\{[^\/]+\}/', '([^/]+)', $routePath);
        $pattern = '#^' . $pattern . '$#';

        if (!preg_match($pattern, $url, $matches)) {
            return false;
        }
        //matches és un array amb totes les coincidències que ha trobat preg_match

        // Eliminem la coincidència completa i conservem només els paràmetres.
        //array_shift elimina el 1r element de l'array.
        array_shift($matches);

        return $matches;
    }
}
