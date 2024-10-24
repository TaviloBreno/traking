<?php

require '../vendor/autoload.php';
require '../routes/web.php';



// Captura a URL da requisição e o método
$uri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Resolve a rota
$route = $router->resolve($uri, $requestMethod);

// Executa a rota, se encontrada
if (is_callable($route)) {
    call_user_func($route);
}
