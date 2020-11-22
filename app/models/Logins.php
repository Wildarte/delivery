<?php

class Logins{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function checkEmailExiste($email){

        $this->db->query("SELECT email FROM logar WHERE email = :e");
        $this->db->bind(":e", $email);

        if($this->db->resultado()):
            return true;
        else:
            return false;
        endif;

    }

    public function armazena($dados){

        $this->db->query("INSERT INTO logar(nome, email, senha) VALUES(:nome, :email, :senha)");

        $this->db->bind(":nome", $dados['nome']);
        $this->db->bind(":email", $dados['email']);
        $this->db->bind(":senha", $dados['senha']);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;

    }

    public function checkLogin($nome, $senha){

        $this->db->query("SELECT * FROM logar WHERE nome = :e");
        $this->db->bind(":e", $nome);

        if($this->db->resultado()):
            $resultado = $this->db->resultado();
            if(password_verify($senha, $resultado->senha)):
                return $resultado;
            else:
                return false;
            endif;

        else:
            return false;
        endif;

    }

}