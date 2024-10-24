<?php

namespace App\Controllers;

use App\Models\Pedido;
use Core\View;

class PedidoController
{
    private $pedidoModel;

    public function __construct()
    {
        // Valida se o usuário está logado
        $this->checkSession();

        // Inicializa o modelo de pedidos
        $this->pedidoModel = new Pedido();
    }

    /**
     * Verifica se o usuário está logado.
     */
    private function checkSession()
    {
        // Inicia a sessão apenas se ela não tiver sido iniciada ainda
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica se o usuário está logado
        if (!isset($_SESSION['user_id'])) {
            // Verifica se a página acessada não é a de login
            if ($_SERVER['REQUEST_URI'] !== '/login') {
                // Redireciona para a página de login se não estiver autenticado
                header('Location: /login');
                exit;
            }
        }
    }

    public function create()
    {
        // Renderiza a view do formulário de criação de pedido
        $view = new View();
        $view->render('pedidos/criar_pedido');
    }

    public function store()
    {
        // Processa a submissão do formulário
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do pedido do formulário
            $data = [
                'descricao' => $_POST['descricao'],
                'cliente' => $_POST['cliente'],
                'status' => $_POST['status'],
                'data' => $_POST['data'],
            ];

            // Salva o pedido no banco de dados
            $this->pedidoModel->create($data);

            // Redireciona ou exibe uma mensagem de sucesso
            header('Location: /');
            exit;
        }
    }

    public function update($id)
    {
        $data = [
            'cliente' => $_POST['cliente'],
            'status' => $_POST['status'],
            'data_envio' => $_POST['data_envio'],
            'descricao' => $_POST['descricao']
        ];

        $updated = $this->pedidoModel->update($id, $data); // Atualiza o pedido no banco

        if ($updated) {
            header('Location: /');
            exit;
        } else {
            // Caso haja erro na atualização
            http_response_code(500);
            echo "Erro ao atualizar o pedido.";
            exit;
        }
    }

    public function edit($id)
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

        // Renderiza a view com o formulário de edição do pedido
        $view = new View();
        $view->render('pedidos/editar_pedido', ['pedido' => $pedido]);
    }

    public function delete($id)
    {
        $deleted = $this->pedidoModel->delete($id); // Deleta o pedido do banco

        if ($deleted) {
            header('Location: /');
            exit;
        } else {
            // Caso haja erro na exclusão
            http_response_code(500);
            echo "Erro ao excluir o pedido.";
            exit;
        }
    }
}
