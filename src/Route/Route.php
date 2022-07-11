<?php

namespace Route\Route;

use Route\Core\Bootstrap;

class Route extends Bootstrap
{
    private ?HttpErrorRoute $error;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var string $route
     * @var string $uri
     * @return bool
     */
    private function findUri($route, $uri): bool
    {
        $uriWithoutParams = extract_params($route);
        $uri = ($uri === "" ? "/" : $uri);
        $compareUris = strncmp($uriWithoutParams, $uri, strlen($uriWithoutParams));
        $arrRoute = array_filter(explode('/', $route), fn($e) => $e !== '');
        $arrUri = array_filter(explode('/', $uri), fn($e) => $e !== '');
        if ($compareUris === 0 && count($arrRoute) === count($arrUri)) {
            var_dump($arrRoute, $arrUri);
            return true;
        }
        return false;
    }

    /**
     * @void
     */
    public function run(): void
    {
        foreach ($this->routes as $method => $data) {
            if ($method !== $this->method) {
                continue;
            }
            $routeCheck = [];
            array_walk($data, function ($e) use (&$routeCheck) {
                if ($this->findUri($e['route'], $this->uri)) {
                    $routeCheck = $e;
                }
            });
            if (empty($routeCheck)) {
                $this->error = new HttpErrorRoute(404, 'Not Found');
                return;
            }
            if ($routeCheck) {
                $paramsArray = uri_params_array($routeCheck['route'], $this->uri);
                if ($routeCheck['handler'] instanceof \Closure) {
                    $routeCheck['handler']($paramsArray);
                    return;
                }
                $class = explode('@', $routeCheck['handler'])[0];
                $method = explode('@', $routeCheck['handler'])[1];
                if (!class_exists($class) || !method_exists($class, $method)) {
                    $this->error = new HttpErrorRoute(501, 'Not Implemented');
                    return;
                }
                (new $class())->$method($paramsArray);
                return;
            }
        }
    }

    /**
     * @return ?HttpErrorRoute
     */
    public function getError(): ?HttpErrorRoute
    {
        return ($this->error ?? null);
    }
}
