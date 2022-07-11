<?php

namespace Route\Core;

use Route\Route\RouteInterface;

abstract class Bootstrap implements RouteInterface
{
    protected string $method;
    protected string $uri;
    protected array $routes;

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->setUri();
        $this->routes = [];
    }

    /**
     * @var string $route
     * @var string|callable $handler
     * @return void
     */
    public function get(string $route, $handler): void
    {
        $this->setRoutes('GET', $route, $handler);
    }

    /**
     * @var string $route
     * @var string|callable $handler
     * @return void
     */
    public function post(string $route, $handler): void
    {
        $this->setRoutes('POST', $route, $handler);
    }

    /**
     * @var string $route
     * @var string|callable $handler
     * @return void
     */
    public function put(string $route, $handler): void
    {
        $this->setRoutes('PUT', $route, $handler);
    }

    /**
     * @var string $route
     * @var string|callable $handler
     * @return void
     */
    public function patch(string $route, $handler): void
    {
        $this->setRoutes('PATCH', $route, $handler);
    }

    /**
     * @var string $route
     * @var string|callable $handler
     * @return void
     */
    public function delete(string $route, $handler): void
    {
        $this->setRoutes('DELETE', $route, $handler);
    }

    /**
     * @var string $httpMethod
     * @var string $route
     * @var string|callable $handler
     * @return void
     */
    private function setRoutes(string $httpMethod, string $route, $handler): void
    {
        $this->routes[$httpMethod][] = [
            'route' => $route,
            'handler' => $handler
        ];
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    private function setUri()
    {
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->uri = ($this->uri === "" ? "/" : $this->uri);
        $this->uri = $this->uri[strlen($this->uri) - 1] === '/' ? substr($this->uri, 0, -1) : $this->uri;
    }
    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
