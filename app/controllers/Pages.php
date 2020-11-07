<?php

class Pages extends Controller{

    public function index(){
        $dados = [
            'titulo' => 'Título da Página',
            'descricao' => 'descrição qualquer'
        ];

        $this->view('pages/home', $dados);
    }

    public function sobre(){
        $dados = [
            'titulo' => 'Título de Sobre',
            'descricao' => 'Descrição da página Sobre'
        ];

        $this->view('pages/sobre', $dados);
    }

    public function cadex(){
       
    }

    public function contato(){

        $dados = [
            'titulo' => 'Título de contatos',
            'descricao' => 'Descrição de Contato'
        ];

        $this->view('pages/contato', $dados);
    }

    public function painel(){

        $dados = [
            'titulo' => 'Título do Painel',
            'descricao' => 'Descrição do Painel'
        ];

        $this->view('pages/painel', $dados);

    }

}