<?php

class Usuario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrar($nome, $email, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $query = $this->conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        if ($query === false) {
            return "Erro na preparação da consulta: " . $this->conn->error;
        }

        $query->bind_param("sss", $nome, $email, $senhaHash);

        if ($query->execute()) {
            return "Cadastro realizado com sucesso!";
        } else {
            return "Erro: " . $query->error;
        }
    }


    public function login($email, $senha) {
        $senhaHash = '';

        $stmt = $this->conn->prepare("SELECT senha FROM usuarios WHERE email = ?");

        if ($stmt === false) {
            return "Erro na preparação da consulta: " . $this->conn->error;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($senhaHash);
            $stmt->fetch();

            if (!empty($senhaHash) && password_verify($senha, $senhaHash)) {
                return "Login realizado com sucesso!";
            } else {
                return "Senha incorreta.";
            }
        } else {
            return "Usuário não encontrado.";
        }
    }
}
?>
