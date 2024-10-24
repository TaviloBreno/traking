<?php

namespace App\Models;

use Core\Database;

class User
{
    private $db;
    protected $id;
    protected $nome;
    protected $email;
    protected $senha;
    protected $criado_em;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchObject(self::class);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function returnSenha($email)
    {
        $this->senha = $this->findByEmail($email)->senha;
        return $this->senha;
    }

    public function returnId($email)
    {
        $this->id = $this->findByEmail($email)->id;
        return $this->id;
    }
}
