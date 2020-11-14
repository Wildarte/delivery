<?php
/*
    * controlador base
    * carrega os modelos e as views
*/

class Controller{

    //carrega os modelos
    public function model($model){
        //requere  o arquivo do model
        require_once '../app/models/'.$model.'.php';
        //instancia o modelo
        return new $model;
    }

    //carrega as views
    public function view($view, $dados = []){
        $arquivo = ('../app/views/'.$view.'.php');
        if(file_exists($arquivo)):
            //requere o arquivo de view
            require_once $arquivo;
        else:
            //a função die() termina a execução do script
            die("O arquivo de view não existe");
        endif;
    }

}