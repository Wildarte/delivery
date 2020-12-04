<?php


class Login extends Controller{

    public function __construct()
    {
        $this->userModel = $this->model("Logins");
    }

    public function index(){

        $dados = [
            'nome' => '',
            'senha' => '',
            'nome_erro' => '',
            'senha_erro' => '',
        ];

        $this->view('login/index', $dados);

    }

    public function cadastrar(){

        //filter_input_array recebe o os dados do formulário e os coloca em um array
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        if(isset($form)):

            $dados = [
                'nome' => trim($form['nome']),
                'email' => trim($form['email']),
                'senha' => trim($form['senha']),
                'confirma_senha' => trim($form['confirma_senha']),
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => ''
            ];

            if(in_array("", $form))://se existir algum campo em branco no formulário

                if(empty($form['nome'])):
                    $dados['nome_erro'] = "Preencha o campo nome";
                endif;
                if(empty($form['email'])):
                    $dados['email_erro'] = "Preencha o campo email";
                endif;
                if(empty($form['senha'])):
                    $dados['senha_erro'] = "Preencha o campo senha";
                endif;
                if(empty($form['confirma_senha'])):
                    $dados['confirma_senha_erro'] = "Preencha o campo confirma senha";
                
                endif;
            
            else:
                if(!Check::checkNome($form['nome'])):
                    $dados['nome_erro'] = "Nome inválido";
                elseif(!Check::checkEmail($form['email'])):
                    $dados['email_erro'] = "O email informado é inválido";
                elseif($this->userModel->checkEmailExiste($form['email'])):
                    $dados['email_erro'] = "Esse email já está cadastrado";
                elseif(strlen($form['senha']) < 6):
                    $dados['senha_erro'] = "A senha deve conter no mínimo 6 caracteres";
                elseif($form['senha'] != $form['confirma_senha']):
                    $dados['confirma_senha_erro'] = "As senhas devem ser iguais";
                else:
                    $dados['senha'] = password_hash($form['senha'], PASSWORD_DEFAULT);
                    echo "<p>Pode cadastrar</p>";

                    if($this->userModel->armazena($dados)):
                        echo "<h2>Cadastro realizado com sucesso</h2>";
                    else:
                        die("Erro ao armazenar login");
                    endif;
                endif;

            endif;

            var_dump($dados);
        else:

            $dados = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'confirma_senha' => '',
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => ''
            ];

        endif;

        $this->view('login/cadastrar', $dados);
    }



    public function logar(){
        
        //filter_input_array recebe o os dados do formulário e os coloca em um array
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        if(isset($form)):

            $dados = [
                'nome' => trim($form['nome']),
                'senha' => trim($form['senha']),
                'nome_erro' => '',
                'senha_erro' => ''
            ];

            if(in_array("", $form))://se existir algum campo em branco no formulário

                if(empty($form['nome'])):
                    $dados['nome_erro'] = "Preencha o campo email";
                endif;
                if(empty($form['senha'])):
                    $dados['senha_erro'] = "Preencha o campo senha";
                endif;
            
            else:
                if(!Check::checkNome($form['nome'])):
                    $dados['nome_erro'] = "O nome informado é inválido";
                else:

                    $user = $this->userModel->checkLogin($form['nome'], $form['senha']);

                    if($user):
                        $this->criarSessionUSer($user);
                        echo "Tudo certo pode iniciar sessão";
                    else:
                        Sessao::msg('usuario', 'Usuário ou senha inválido', 'alert alert-danger');
                    endif;

                endif;

            endif;

            var_dump($dados);
        else:

            $dados = [
                'nome' => '',
                'senha' => '',
                'nome_erro' => '',
                'senha_erro' => '',
            ];

        endif;

        $this->view('login/index', $dados);

    }

    private function criarSessionUSer($user){
        $_SESSION['user_id'] = $user->id_login;
        $_SESSION['user_nome'] = $user->nome;
        $_SESSION['user_senha'] = $user->senha;

        Url::redirect("user/index");
    }

    public function sair(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_nome']);
        unset($_SESSION['user_senha']);

        session_destroy();

        Url::redirect('login/index');
    }

}