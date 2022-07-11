<?php

namespace Route\Route;

interface RouteInterface
{
    public function get(string $route, string $handler): void;
    public function post(string $route, string $handler): void;
    public function put(string $route, string $handler): void;
    public function patch(string $route, string $handler): void;
    public function delete(string $route, string $handler): void;
}
