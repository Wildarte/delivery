<?php

class Pedidos extends Controller{

    public function __construct()
    {
        $this->userModel = $this->model("Pedido");
    }
    
    public function index(){
        
        echo "<p class='text-center' style='margin-top: 10vh'><a href=".URL.">Início</a></p>";

    }


    //esse é o método responsável pela confirmação do pedido
    public function confirma(){
        
        //esse trecho serve para validar os dados que são recebidos pelo formulário
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($form)):

            if($form['submit'] == "Confirmar"):

                $dados = [
                    'nome' => trim($form['nome_cliente']),
                    'valor_total' => trim($form['valor_total']),
                    'numero_itens' => trim($form['num_itens']),
                ];

                $nome_cliente = $dados['nome'];

                if($this->userModel->cadastraPedido($nome_cliente)):

                    //echo "Id pedido gerado <br>";
                    //echo "Nome cliente: ". $nome_cliente . "<br>";
                    //echo "Id do produto: ", $dados['id_produto']."<br>";
                    //echo "Valor total do pedido: ",  $dados['valor_total']."<br>";
                    //echo "Valida Ítem: ", $dados['valida_item'];

                    //aqui é para pegar o id gerado na tabela produto
                    $db2 = new Database();
                    $db2->query("SELECT id_ped FROM pedidos WHERE cliente = '".$nome_cliente."'");
                    
                    //esse trecho traz o id gerado
                    foreach($db2->resultados() as $pedido):
                        $id_pedido = $pedido->id_ped;
                        //echo "O id gerado foi é foda: ". $id_pedido."<br>";
                        $dados['id_pedido'] = $id_pedido;
                    endforeach;
                    // **************************


                    $contagem = intval($dados['numero_itens'])-1;
                    //echo "Número de ítem + 1: ".$contagem. "<br>";
                    
                    for($x = 1; $x <= $contagem; $x++):
                        
                        

                        $valida = intval($form['valida_item'.$x]);
                        //echo "<h2> numero valida item".$valida."</h2>";

                        if($valida != 0):
                            for($x2 = 1; $x2 <= $valida; $x2++):
                                $id_produto = $form['id_produto'.$x];
                                //echo "ID DO PRODUTO: ", $id_produto."<br>";
                                if($this->userModel->cad_pedido_produto($id_produto, $id_pedido, $dados['valor_total'])):
                                    //echo "Pedido cadastrado co sucesso";
                                else:
                                    //echo "Erro ao cadastrar pedido";
                                endif;
                            endfor;
                        endif;
                    endfor;
                else:
                    echo "Erro ao gerar pedido";
                endif;
                
                $this->view('pedidos/confirma', $dados);

            else:

            endif;
            
        endif;

        echo "<p class='text-center my-5 esconde-print'><a href=".URL.">Início</a></p>";
            
    }

}