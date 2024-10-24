<?php

namespace App\Controllers;

use App\Models\User;
use Core\View;

class AuthController
{
    private $userModel;
    private $view;

    public function __construct()
    {
        // Inicializa o modelo do usuário e a view
        $this->userModel = new User();
        $this->view = new View();
    }

    /**
     * Exibe a página de login.
     */
    public function showLogin()
    {
        if(isset($_SESSION['user_id'])){
            header('Location: /');
            exit;
        }

        // Renderiza a página de login
        $this->view->render('auth/login');
    }

    /**
     * Processa o formulário de login.
     */
    public function login()
    {
        // Obtém os dados do formulário e faz validações
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if (!$email || !$password) {
            // Se o e-mail ou senha estiverem inválidos, exibe uma mensagem de erro
            $this->view->render('auth/login', ['error' => 'Preencha os campos corretamente.']);
            return;
        }

        // Busca o usuário pelo e-mail
        $user = $this->userModel->findByEmail($email);

        // Verifica se o usuário foi encontrado e se a senha está correta
        if ($user && md5($password) === $user->returnSenha($email)) {
            // Inicia a sessão (se ainda não estiver ativa)
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Armazena o ID do usuário na sessão
            $_SESSION['user_id'] = $user->returnId($email);

            // Redireciona para a página inicial
            header('Location: /');
        }

        // Se o usuário não foi encontrado ou a senha está incorreta, exibe uma mensagem de erro
        $this->view->render('auth/login', ['error' => 'E-mail ou senha incorretos.']);
    }


    /**
     * Realiza o logout do usuário.
     */
    public function logout()
    {
        // Inicia a sessão (se ainda não estiver ativa)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Remove o ID do usuário da sessão
        session_unset();  // Limpa todas as variáveis da sessão
        session_destroy(); // Destroi a sessão

        // Redireciona para a página de login
        header('Location: /login');
        exit;
    }
}
