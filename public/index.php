<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';

use App\Controllers\PedidoController;

// Exemplo de roteamento básico
$controller = new PedidoController();
$controller->index();
