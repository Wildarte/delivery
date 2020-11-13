<?php


class Pedidos{

    
    public static function verificaId($id){
        
        $db = new Database();

        $db->query("SELECT * FROM pedidos WHERE $id");
        
        if($db->executa()):
            return true;
        else:
            return false;
        endif;

    }

}