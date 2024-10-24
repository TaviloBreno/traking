<?php

namespace App\Controllers;

use App\Models\Pedido;
use Core\View;

class ConsultaPedidoController
{
    private $pedidoModel;

    public function __construct()
    {
        $this->pedidoModel = new Pedido();
    }

    /**
     * Exibe a lista de todos os pedidos.
     */
    public function index()
    {
        // Obtém todos os pedidos do modelo
        $pedidos = $this->pedidoModel->getAll();

        // Renderiza a view de listagem de pedidos
        $view = new View();
        $view->render('pedidos/index', ['pedidos' => $pedidos]);
    }

    /**
     * Exibe os detalhes de um pedido específico.
     *
     * @param int $id ID do pedido
     */
    public function show($id)
    {
        // Busca o pedido pelo ID
        $pedido = $this->pedidoModel->find($id);

        // Se o pedido não for encontrado, redireciona para uma página de erro 404
        if (!$pedido) {
            // Exibe uma mensagem de erro ou renderiza uma view de erro 404
            $view = new View();
            $view->render('shared/404');
            return;
        }

        // Renderiza a view com os detalhes do pedido
        $view = new View();
        $view->render('pedidos/show', ['pedido' => $pedido]);
    }
}
