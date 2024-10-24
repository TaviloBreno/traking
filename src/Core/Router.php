<?php

namespace Core;

class Router
{
    private $routes = [];

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function resolve($uri, $requestMethod)
    {
        // Remove a parte do domínio da URL e os parâmetros de consulta
        $uri = strtok($uri, '?');

        // Verifica se existe uma rota exata
        if (isset($this->routes[$requestMethod][$uri])) {
            return $this->routes[$requestMethod][$uri];
        }

        // Se não encontrar a rota exata, verifica se é uma rota dinâmica
        foreach ($this->routes[$requestMethod] as $route => $handler) {
            // Substitui padrões como {id} por uma regex para capturar números
            $routePattern = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_-]+)', $route);
            $routePattern = "#^" . $routePattern . "$#";

            // Verifica se a URL corresponde ao padrão da rota dinâmica
            if (preg_match($routePattern, $uri, $matches)) {
                array_shift($matches); // Remove o primeiro elemento que é a URL completa

                // Retorna o handler (controlador) e os parâmetros capturados
                return call_user_func_array($handler, $matches);
            }
        }

        // Caso não encontre a rota, retorna erro 404
        http_response_code(404);
        echo "404 - Página não encontrada.";
        exit;
    }
}
