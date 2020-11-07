<?php
/*
    *Classe Rota
    *Cria as URL, carrega os controladores, métodos e parametros
    *Formato URL - /controlador/metodo/parametros
*/

class Rota{
    //atributos da classe
    private $controlador = "Pages";
    private $metodo = "index";
    private $parametro = [];

    public function __construct()
    {
        //se a url existir joga a funcao url na variavel $url
       $url = $this->url() ? $this->url() : [0];

        //checa se o controlador existe
        //ucwords - converte para maiusculas o primeiro caractere de cada palavra
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')):
            //se existir seta como controlador
            $this->controlador = ucwords($url[0]);
            //unset - destrói a variável específica
            unset($url[0]);
        endif;

        //requere o controlador
        require_once '../app/controllers/'.$this->controlador.'.php';
        //instancia o controlador
        $this->controlador = new $this->controlador;

        //checa se o metodo existe, segunda parte da url
        if(isset($url[1])):
            //method_exists - checa se o método da classe existe
            if(method_exists($this->controlador, $url[1])):
                $this->metodo = $url[1];
                unset($url[1]);
            endif;
        endif;

        //se existir retorna um array com os valores se nao restorna um array vazio
        //array_values - retorna todos os valores de um array
        $this->parametro = $url ? array_values($url) : [];
        //call_user_func_array - chama uma dada função de usuário com um array de parametro
        call_user_func_array([$this->controlador, $this->metodo], $this->parametro);

    }

    //retorna a url em um array
    private function url(){
        //o filtro FILTER_SANITIZE_URL remove todos os caracteres ilegais de uma url
        //essa linha filtra pra mim a url que o usuário possa colocar no campo de url do navegador
        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

        //verifica se a url existe
        if(isset($url)):

            //a função trim() retira os espaços do início e do final da string
            //rtrim() retira espaços em branco ou outros caracteres do final da string
            $url = trim(rtrim($url, "/"));

            //explode() retorna uma string de strings
            $url = explode("/", $url);
        
            return $url;
        endif;

    }

}