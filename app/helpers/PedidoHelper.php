<?php


class PedidoHelper{

    
    public static function checkNomeProduto($nome){
        
        $db = new Database();

        $db->query("SELECT * FROM produtos WHERE nome = '".$nome."'");
        
        if($db->resultados()):
            return true;
        else:
            return false;
        endif;

    }

}