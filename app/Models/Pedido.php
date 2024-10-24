<?php

namespace App\Models;

use Core\Database;
use PDO;

class Pedido
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM pedidos");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM pedidos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($data)
    {
        // Prepara a consulta SQL para inserir um novo pedido com os campos: cliente, status, data, descrição e data_envio
        $stmt = $this->db->prepare("INSERT INTO pedidos (cliente, status, criado_em, descricao, data_envio) 
                                VALUES (:cliente, :status, :data, :descricao, now())");

        // Vincula o valor do cliente fornecido ao parâmetro SQL :cliente
        $stmt->bindParam(':cliente', $data['cliente']);

        // Vincula o valor do status fornecido ao parâmetro SQL :status
        $stmt->bindParam(':status', $data['status']);

        // Vincula o valor da data fornecida ao parâmetro SQL :data
        $stmt->bindParam(':data', $data['data']);

        // Vincula o valor da descrição fornecida ao parâmetro SQL :descricao
        $stmt->bindParam(':descricao', $data['descricao']);

        // Executa a consulta SQL preparada, inserindo o novo pedido no banco de dados
        $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("
        UPDATE pedidos 
        SET cliente = :cliente, status = :status, data_envio = :data_envio, descricao = :descricao 
        WHERE id = :id
    ");
        $stmt->bindParam(':cliente', $data['cliente']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':data_envio', $data['data_envio']);
        $stmt->bindParam(':descricao', $data['descricao']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM pedidos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
