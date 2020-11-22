<?php


class Check{

    public static function checkNome($dado){
        if(preg_match('/[a-z,A-Z]/m', $dado)):
            return true;
        else:
            return false;
        endif;
    }

    public static function checkEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)):
           return true;
        else:
            return false; 
        endif;
    }
    
}