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

    public function atualiza($dados, $id){

        $this->db->query("UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem WHERE id = $id ");
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
    
    public function excluir($id){
        $this->db->query("DELETE FROM produtos WHERE id = $id");

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;
    }

    public function atualizaMsg($msg){

        $this->db->query("UPDATE user SET msg = :msg");
        $this->db->bind(":msg", $msg);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;

    }
}