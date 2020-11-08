<?php


class Users{

    private $db;

    public function __construct(){

        $this->db = new Database();

    }

    public function armazena($dados){

        $this->db->query("INSERT INTO produtos(nome, descricao, preco, imagem) VALUES(:nome,:descricao,:preco,:imagem)");
        $this->db->bind(":nome", $dados['nome']);
        $this->db->bind(":descricao", $dados['descricao']);
        $this->db->bind(":preco", $dados['preco']);
        $this->db->bind(":imagem",$dados['imagem']);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }
    

}