<?php

class User extends Controller{ 

    public function index(){

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($form)):
            
            $dados = [
                'nome' => trim($form['nome-produto']),
                'descricao' => trim($form['descricao-produto']),
                'preco' => trim($form['preco-produto']),
                'imagem' => trim($form['imagem-produto'])
            ];
        else:
            $dados = [
                'nome' => '',
                'descricao' => '',
                'preco' => '',
                'imagem' => ''
            ];
        endif;
        

        $this->view("user/index");
        
    }


}