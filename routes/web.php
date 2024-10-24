<?php

use Core\Router;
use App\Controllers\PedidoController;
use App\Controllers\ConsultaPedidoController;

$router = new Router();
$pedidoController = new PedidoController();
$consultaController = new ConsultaPedidoController();

// Definindo as rotas
$router->get('/', [$consultaController, 'index']); // Lista todos os pedidos
$router->get('/pedido/criar', [$pedidoController, 'create']); // Para exibir o formulário
$router->get('/pedido/{id}', [$consultaController, 'show']); // Para exibir um pedido específico
$router->post('/pedido/criar', [$pedidoController, 'store']); // Para processar o formulário
$router->get('/pedido/editar/{id}', 'PedidoController@edit'); // Exibe o formulário de edição
$router->post('/pedido/editar/{id}', 'PedidoController@update'); // Processa a atualização do pedido



