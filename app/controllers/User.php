<?php

class User extends Controller{ 

    public function __construct()
    {
        $this->userModel = $this->model("Users");
    }
    

    public function index(){

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        /********* Esse trecho salva a imagem no diretório public/images ************** */

        if(isset($_POST['submit'])){

            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES['imagem-produto']['name']); 
            $uploadOk = 1;

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES['imagem-produto']['tmp_name']); //obtem o tamanho de uma imagem
            if($check !== false){ //verifica se o arquivo é uma imagem
                echo "O arquivo é uma imagem - " . $check['mime'] . ".";
                $uploadOk = 1;


                
                if(file_exists($target_file)){
                    echo "Esse arquivo já existe";
                }else{
                    
                    if($_FILES['imagem-produto']['size'] > 500000){
                        echo "Seu arquivo é muito grande";
                        $uploadOk = 0;
                    }else{
                        
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                            echo "Só é permitido arquivos jpg, png, jpeg e gif";
                            $uploadOk = 0;
                        }else{
                            
                            if($uploadOk == 0){
                                echo "Desculpe seu arquivo não pode ser carregado";
                            }else{
                                
                                if(move_uploaded_file($_FILES['imagem-produto']['tmp_name'], $target_file)){
                                    echo "O arquivo" . htmlspecialchars(basename($_FILES['imagem-produto']['name'])) . " foi salvo ";
                                }else{
                                    echo "Ocorreu algum erro ao carregar seu arquivo";
                                }
                            }
                        }
                    } 
                }
        
                echo "<br>".$target_file."<br>";
            }else{
                echo "O arquivo não é uma imagem";
                $uploadOk = 0;
            }
            
        }

          /*************************************************** */

        if(isset($form)):

            

            $dados = [
                'nome' => trim($form['nome-produto']),
                'descricao' => trim($form['descricao-produto']),
                'preco' => (float) trim($form['preco-produto']),
                'imagem' => $target_file
            ];


            if($this->userModel->armazena($dados)):
                
                echo "Cadastrado";
            else:
                echo "Erro ao executar o cadastramento";
            endif;    
            

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