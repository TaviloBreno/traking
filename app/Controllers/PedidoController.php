<?php

namespace App\Controllers;

use Core\Database;

class PedidoController
{
    public function index()
    {
        $db = Database::getConnection();
        echo "Conectado ao banco de dados com sucesso!";
    }
}
