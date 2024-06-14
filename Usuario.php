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


    public function login($nome, $senha) {
        $senhaHash = '';

        $query = $this->conn->prepare("SELECT senha FROM usuarios WHERE nome = ?");

        if ($query === false) {
            return "Erro na preparação da consulta: " . $this->conn->error;
        }

        $query->bind_param("s", $nome);
        $query->execute();
        $query->store_result();

        if ($query->num_rows > 0) {
            $query->bind_result($senhaHash);
            $query->fetch();

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
