<?php


class Pedido{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function cadastraPedido($cliente){

        $this->db->query("INSERT INTO pedidos (cliente) VALUES(:cliente)");
        $this->db->bind(":cliente", $cliente);

        if($this->db->executa()):
            return true;

        else:
            return false;
        endif;

    }


    //função que adiciona pedido na tabela pedidos_produtos
    public function cad_pedido_produto($idProd, $idPed, $valor){

        $this->db->query("INSERT INTO pedidos_produtos (id_prod, id_ped, valor) VALUES(:id_prod, :id_ped, :valor)");
        $this->db->bind(":id_prod", $idProd);
        $this->db->bind(":id_ped", $idPed);
        $this->db->bind(":valor", $valor);

        if($this->db->executa()):
            return true;
        else:
            return false;
        endif;

    }

    public function retornaIdCliente($cliente){
        $this->db->query("SELECT * FROM pedidos WHERE cliente = $cliente");

        foreach($this->db->resultados() as $id):
             $id->id_ped;
        endforeach;
    }


}