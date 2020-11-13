<div class="container" style="margin-top: 10vh;" id="print">

    <div class="row">

        <div class="col-12">

            <div class=" h3 text-center alert alert-success">Seu Pedido foi confirmado e poderá ser retirado no restaurante Cleber hoje em até 2 horas</div>

        </div>

    </div>

    <div class="row">

        <div class="col-12">

            
                <div class="card alert alert-primary">
                    <div class="card-body">
                        <p class="card-text"><strong>ID Pedido: <?= $dados['id_pedido'] ?></strong></p>

                            <h3 class="card-title">Resumo do Pedido</h3>
                            
                            <p class="card-text"> <strong>Nome: <?= $dados['nome'] ?> </strong> </p>
                            


                            <?php
                                //ESSE TRECHO DE CÓDIGO É RESPONSÁVEL POR LISTAR TODOS OS PRODUTOS QUE O CLIENTE COMPROU COM AS SUAS RESPECTIVAS QUANTIDADES

                                //acessa o banco de dados
                                $db = new Database();
                                $db->query("SELECT * FROM pedidos_produtos WHERE id_ped = ".$dados['id_pedido']."");

                                
                                $id_atual = 0;
                                
                                foreach($db->resultados() as $produto):
                                    
                                    $nome_produto;//essa variavel recebe o nome dos produtos do pedido

                                    $produto_completo = "";//essa variavel fica responsável em receber todo o nome do produto e sua quantidade para ser exibido no final

                                    
                                    //nesse trecho é verificado se a variavel $id_atual é diferente da $produto->id_prod, pq no final dessa condição eu coloco o id que eu usei para contar a quantidade do produto na variavel $id_atual, portanto se essa der true quer dizer que eu posso contar um produto diferente, é um complicado mesmo, eu demorei para desenvolver essa lógica, talvez se eu tivesse feito de outra forma seria mais fácil, mas assim pelo menos ta funcionando (risos)
                                    if($id_atual != $produto->id_prod):

                                        //busca todas as linhas que atendam as condições da id_ped e id_prod
                                        $db->query("SELECT * FROM pedidos_produtos WHERE id_ped = ".$dados['id_pedido']." AND id_prod = $produto->id_prod");
                                        $conta_item = 0;//essa é a variavel que armazenará a quantidade de itens individuais e mostrara ao final para o cliente

                                        foreach($db->resultados() as $item):

                                            $conta_item++; //acrescenta +1 a variavel $conta_item

                                            //busca na tabela produto os itens que a coluna id é igual a $produto->id_prod
                                            $db->query("SELECT nome FROM produtos WHERE id = $produto->id_prod");
                                            
                                            foreach($db->resultados() as $item_produto):

                                                $nome_produto = $item_produto->nome;//armazena o nome do produto atual na variavel $nome_produto
                                                
                                            endforeach;


                                            //essa variavel está recebendo o nome do produto que estava armazenado na variavel $nome_produto e a sua quantidade que estava armazenado na variavel $conta_item
                                            $produto_completo = "<b>Produto:</b> " . $nome_produto." | <b>Quantidade:</b> ".$conta_item . "X";

                                        endforeach;
                                    endif;

                                    //essa linha imprime para o usuário o nome do produto e sua quantidade
                                    ?> <p class="card-text"> <?= $produto_completo ?></p> <?php
                                    $id_atual = $produto->id_prod;
                                endforeach;


                            // ** FIM DO TRECHO DE CÓDIGO RESPONSÁVEL POR LISTAR TODOS OS PRODUTOS QUE O CLIENTE COMPROU COM AS SUAS RESPECTIVAS QUANTIDADES
                            ?>
                                

                            <hr>
                            <p class="card-text"> <strong> Total: <?= $dados['valor_total'] ?> </strong> </p>
                        
                    </div>
                </div>
            

        </div>
    
    </div>
</div>

<div class="container">

    <div class="row">

        <div class="col-12">
            <p class="esconde-print">
                <button type="button" name="" id="" onclick="window.print()" class="btn btn-primary">Salvar Comprovante</button>
                <a href="<?=URL?>" name="" id="" class="btn btn-warning">Voltar ao início</a>
            </p>
        </div>

    </div>
                            
</div>