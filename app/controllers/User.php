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


                
                
                    if($_FILES['imagem-produto']['size'] > 500000){
                        echo "<script>alert('Seu arquivo é muito grande')</script>";
                        $uploadOk = 0;
                    }else{
                        echo "Seu arquivo tem o tamanho ideal";
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                            echo "Só é permitido arquivos jpg, png, jpeg e gif";
                            $uploadOk = 0;
                        }else{
                            echo "O arquivo é um jpg, png, jpeg ou gif";
                            if($uploadOk == 0){
                                echo "Desculpe seu arquivo não pode ser carregado";
                            }else{
                                echo "Seu arquivo pode ser carregado";
                                if(move_uploaded_file($_FILES['imagem-produto']['tmp_name'], $target_file)){
                                    echo "O arquivo" . htmlspecialchars(basename($_FILES['imagem-produto']['name'])) . " foi salvo ";

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
                                            var_dump($dados);
                                            var_dump($form);
                                            var_dump($this->userModel);
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

                                }else{
                                    echo "Ocorreu algum erro ao carregar seu arquivo";
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

        
        
        
        $this->view("user/index");
        
    }


    //essa funcão serve para armazenar os dados
    public function editar(){

        if($_POST['submit'] == 'Excluir'){
            
            if($this->userModel->excluir($_POST['id_produto'])):
                echo "<script>alert('Produto excluído')</script>";
            else:
                echo "<script>alert('Erro ao excluir produto')</script>";
            endif;
        }else{

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
                    
                        echo "O arquivo não existia";
                        if($_FILES['imagem-produto']['size'] > 500000){
                            echo "<script>alert('Seu arquivo é muito grande')</script>";
                            $uploadOk = 0;
                        }else{
                            echo "Seu arquivo tem o tamanho ideal";
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                                echo "Só é permitido arquivos jpg, png, jpeg e gif";
                                $uploadOk = 0;
                            }else{
                                echo "O arquivo é um jpg, png, jpeg ou gif";
                                if($uploadOk == 0){
                                    echo "Desculpe seu arquivo não pode ser carregado";
                                }else{
                                    echo "Seu arquivo pode ser carregado";
                                    if(move_uploaded_file($_FILES['imagem-produto']['tmp_name'], $target_file)){
                                        echo "O arquivo" . htmlspecialchars(basename($_FILES['imagem-produto']['name'])) . " foi salvo ";

                                        if(isset($form)):

                

                                            $dados = [
                                                'id' => trim($form['id_produto']),
                                                'nome' => trim($form['nome-produto']),
                                                'descricao' => trim($form['descricao-produto']),
                                                'preco' => (float) trim($form['preco-produto']),
                                                'imagem' => $target_file
                                            ];
                                
                                
                                            if($this->userModel->atualiza($dados, $dados['id'])):
                                                $this->view("user/index");
                                                echo "Atualizado com Sucesso";
                                                echo "<script>alert('Produto Editado')</script>";
                                                
                                            else:
                                                var_dump($dados);
                                                var_dump($form);
                                                var_dump($this->userModel);
                                                echo "Erro ao executar o atualização";
                                            endif;    
                                            
                                
                                        else:
                                            $dados = [
                                                'nome' => '',
                                                'descricao' => '',
                                                'preco' => '',
                                                'imagem' => ''
                                            ];
                                        endif;

                                    }else{
                                        echo "Ocorreu algum erro ao carregar seu arquivo";
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

        }
        $this->view('user/index');

    }

}