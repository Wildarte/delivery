<?php

class User extends Controller{ 

    public function __construct()
    {
        if(!isset($_SESSION['user_id'])): //caso tenha a sessão, exibe o menu
            Url::redirect('login/logar');
        endif;
        $this->userModel = $this->model("Users");
    }
    

    public function index(){

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        /********* Esse trecho salva a imagem no diretório public/images ************** */

        if(isset($form)){

            if($_POST['submit'] == "Cadastrar"){

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
                                echo "<script>alert('Só é permitido arquivo de imagem')</script>";
                                echo "Só é permitido arquivos jpg, png, jpeg e gif";
                                $uploadOk = 0;
                            }else{
                                echo "O arquivo é um jpg, png, jpeg ou gif";
                                if($uploadOk == 0){
                                    echo "<script>alert('A imagem não pôde ser carregada')</script>";
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
                                                'imagem' => strval(trim($target_file))
                                            ];
                                            echo "TIPO DA IMAGEM: ".$dados['imagem'];
                                            
                                           
                                            if(PedidoHelper::checkNomeProduto($dados['nome'])):
                                                echo "<script>alert('Já existe um produto com esse nome')</script>";
                                            else:
                                                
                                                if($this->userModel->armazena($dados)):
                                                    echo "<script>alert('Produto cadastrado')</script>";
                                                    echo "Cadastrado";
                                                    var_dump($dados);
                                                    var_dump($form);
                                                    var_dump($this->userModel);
                                                else:

                                                    
                                                    $dsn = 'mysql:host=localhost;dbname=delivery';
                                                    

                                                    $pdo = new PDO($dsn, 'root', '');
                                                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                                    try {
                                                        $pdo->exec($this->userModel->armazena($dados));
                                                    } catch (PDOException $e) {
                                                        echo $e->getMessage();
                                                    }

                                                    echo "<script>alert('Erro ao cadastradar Produto')</script>";
                                                    var_dump($dados);
                                                    var_dump($form);
                                                    var_dump($this->userModel);
                                                    echo "Erro ao executar o cadastramento";
                                                endif;  

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

        
        }
        
        $this->view("user/index");
        
    }


    //essa funcão serve para armazenar os dados
    public function editar(){

        if($_POST['submit'] == 'Excluir'){

            $partes = explode("/", $_POST['img_prod']);
            $tamanho = 0;
            foreach($partes as $parte):
                $tamanho++;
            endforeach;
            $imagem_excluir = $partes[$tamanho-1];
            echo "Imagem a excluir: ".$imagem_excluir;
            echo "<script>alert('Essa é a imagem que você deseja excluir?".$imagem_excluir."')</script>";

            if(unlink('images/'.$imagem_excluir)):
                echo "<script>alert('imagem deletada')</script>";
            else:
                echo "<script>alert('Algo deu errado ao deletar a imagem')</script>";
            endif;
            
            if($this->userModel->excluir($_POST['id_produto'])):
                echo "<script>alert('Produto excluído')</script>";
            else:
                echo "<script>alert('Erro ao excluir produto')</script>";
            endif;
        }else{

            $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            /********* Esse trecho salva a imagem no diretório public/images ************** */

            if($_POST['submit'] == "Salvar"){

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

    public function controle(){

        $this->view('user/controle');

    }


    //essa função é responsavel por receber a mensagem de confirmação do formulário e enviar para o model responsável pela comunicação com o banco de dados
    public function msg(){

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($form)):

            if($form['submit'] != 'Confirmar'):
                echo "<script>alert('Algo deu errado ao confirmar')</script>";
            else:
                
                if(!empty($form['msg-confirma'])):
                    $msg = [
                        'msg' => trim($form['msg-confirma'])
                    ];

                    if($this->userModel->atualizaMsg($msg['msg'])):
                        echo "<script>alert('Mensagem atualizada')</script>";
                    else:
                        echo "<script>alert('Algo deu errado ao atualizar a mensagem')</script>";
                    endif;
                else:
                    echo "<script>alert('A mensagem não pode estar vazia')</script>";
                endif;

            endif;

        endif;

        $this->view('user/index');

    }


    //essa função é responsavel por receber o título e subtítulo e enviar para o model responsável pela comunicação com o banco de dados
    public function cabecalho(){

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($form)):

            if($form['submit'] != 'Confirmar'):
                echo "<script>alert('Algo deu errado ao confirmar')</script>";
            else:
                
                if(!empty($form['titulo_cardapio']) && !empty($form['subtitulo_cardapio'])):
                    $dados = [
                        'title' => trim($form['titulo_cardapio']),
                        'subtitle' => trim($form['subtitulo_cardapio'])
                    ];

                    if($this->userModel->atualizaCabecalho($dados)):
                        echo "<script>alert('Cabeçalho Atualizado com Sucesso')</script>";
                    else:
                        echo "<script>alert('Algo deu errado ao atualizar o cabeçalho')</script>";
                    endif;
                else:
                    echo "<script>alert('Os campos não podem estar vazios')</script>";
                endif;

            endif;

        endif;

        $this->view('user/index');

    }

    public function delpedido(){

        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $dados = [
            'alert' => '',
            'text' => ''
        ];

        if(isset($form)):
            
            if(!empty($form['id_pedido'])):

                if($this->userModel->deletePedido($form['id_pedido'])):
                
                    //echo '<script>alert("Pedido '. $form['id_pedido'].' deletado com sucesso")</script>';
                    $dados['alert'] = 'alert-success';
                    $dados['text'] = 'Pedido deletado com sucesso';
                else:
                    //echo '<script>alert("Erro ao deletar pedido '. $form['id_pedido'].'")</script>';
                    $dados['alert'] = 'alert-danger';
                    $dados['text'] = 'Erro ao deletar o pedido';
                endif;

            else:

                $dados['alert'] = 'alert-warning';
                $dados['text'] = 'Nenhum id de pedido encontrado';
            endif;
            
        else:
            $dados['alert'] = 'alert-secondary';
            $dados['text'] = 'Nenhum ID de pedido foi passado';
        endif;
        
        $this->view('user/delpedido', $dados);
        
    }

}