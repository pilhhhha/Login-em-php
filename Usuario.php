<?php

class Usuario 
{
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

        //bind_param function do php para bindar os parametros que estão em ? o primeiro parametro voce define qual TIPO ele é.
        $query->bind_param("s", $nome);
        $query->execute();
        //store_result para armanezar o resultado da execução feita pela query
        $query->store_result();

        if ($query->num_rows > 0) {
            //Se alguma linha for encontrada, bind_result estou pedindo para que ele binda o valor da $senhaHash ao campo senha da query
            $query->bind_result($senhaHash);
            //Usa $query->fetch() para recuperar o valor do campo senha e armazená-lo em $senhaHash
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
