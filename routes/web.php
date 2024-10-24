<?php

use App\Controllers\AuthController;
use Core\Router;
use App\Controllers\PedidoController;
use App\Controllers\ConsultaPedidoController;

$router = new Router();
$pedidoController = new PedidoController();
$consultaController = new ConsultaPedidoController();
$authController = new AuthController();

// Definindo as rotas
$router->get('/', [$consultaController, 'index']); // Lista todos os pedidos
$router->get('/pedido/criar', [$pedidoController, 'create']); // Para exibir o formulário
$router->get('/pedido/{id}', [$consultaController, 'show']); // Para exibir um pedido específico
$router->post('/pedido/criar', [$pedidoController, 'store']); // Para processar o formulário
$router->get('/pedido/editar/{id}', [$pedidoController, 'edit']); // Exibe o formulário de edição
$router->post('/pedido/editar/{id}', [$pedidoController, 'update']); // Processa a atualização do pedido
$router->get('/pedido/deletar/{id}', [$pedidoController, 'delete']); // Exibe o formulário de confirmação de exclusão


// Rota para exibir a página de login
$router->get('/login', [$authController, 'showLogin']);
// Rota para processar o login
$router->post('/login', [$authController, 'login']);
// Rota para logout
$router->get('/logout', [$authController, 'logout']);

