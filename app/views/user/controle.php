<?php include APP.'/views/header.php'; ?>

<div class="container" style="margin-top: 15vh;">
    <div class="row">
        <div class="col-12">
            <header>
                <h2 class="alert alert-success">
                    Controle de Pedidos
                </h2>
                <hr>
            </header>
        </div>
    </div>

    <div class="row esconde-print">
        
            
            <div class="col-md-4 my-2">
                <div class="container">
                    <div class="row">
                        <h5>Buscar por ID</h5>
                    </div>
                </div>
                
                <form action="" method="post" class="form-inline" style="border: 1px solid gray; padding: 3px; border-radius: 5px">
                    
                    <input class="form-control" type="num" name="id" id="" placeholder="Buscar Por Id">
                    <button class=" btn btn-success" type="submit" name="submit" value="busca_id">Buscar</button>
                </form>
            </div>

            <div class="col-md-6 my-2">
                <div class="container">
                    <div class="row">
                        <h5>Bucar por data</h5>
                    </div>
                </div>
                
                <form action="" method="post" class="form-inline " style="border: 1px solid gray; padding: 3px; border-radius: 5px">
                    <b>De</b> <input class="form-control" type="date" name="data-inicio" id="" placeholder="Buscar Por Id">
                    <b>Até</b> <input class="form-control" type="date" name="data-fim" id="" placeholder="Buscar Por Id">
                    <button class="form-control btn btn-success" type="submit" name="submit" value="busca_data">Buscar</button>
                </form>
            </div>
    </div>
    <div class="row esconde-print">
            <div class="col-md-4 my-2">
                <div class="container">
                    <div class="row">
                        <h5>Buscar por Nome</h5>
                    </div>
                </div>
                
                <form action="" method="post" class="form-inline" style="border: 1px solid gray; padding: 3px; border-radius: 5px">
                    
                    <input class="form-control" type="num" name="nome" id="" placeholder="Buscar Por Nome">
                    <button class=" btn btn-success" type="submit" name="submit" value="busca_nome">Buscar</button>
                </form>
            </div>


            <div class="col-md-4 my-2">
                <div class="container">
                    <div class="row">
                        <h5>Listar Até</h5>
                    </div>
                </div>
                
                <form action="" method="post" class="form-inline" style="border: 1px solid gray; padding: 3px; border-radius: 5px">
                    
                    <input class="form-control" type="number" value="10" name="listar" id="" placeholder="Listar">
                    <button class=" btn btn-success" type="submit" name="submit" value="listar">Buscar</button>
                </form>
            </div>

            <div class="col-md-2 my-2 col-6">
                
                <div class="container">
                    <div class="row">
                        <h5>Imprimir Pedidos</h5>
                    </div>
                </div>
                <button class="btn btn-secondary" onclick="window.print()"><i class="fas fa-print"></i> Imprimir</button>
                    
            </div>

            <div class="col-md-2 my-2 col-6">
                <div class="container">
                    <div class="row">
                        <h5>Recarregar</h5>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" onclick="window.location.reload()"><i class="fas fa-redo"></i>
                </button>
            </div>

    </div>
            <hr class="esconde-print">
        
        <div class="col-12" style="margin-top: 5vh;">

            <?php

                $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                
    //  *********** caso o formulario seja setado é entrado nesse trecho de código ************
                if(isset($form)):

                    $valor_busca;

                    $dado_recebe = [
                        'tipo' => trim($form['submit']),
                        
                    ];
                    
                    $db = new Database();

    
    //****************  caso a pesquisa seja por id ************************************* */
                    if($dado_recebe['tipo'] == 'busca_id'):
                        echo "tipo busca: ".$dado_recebe['tipo'];
                        $valor = intval($form['id']);
                        echo "id: ". $valor;
                        $db->query("SELECT * FROM pedidos WHERE id_ped = $valor");
    


    //****************** caso a pesquisa seja por nome ********************* */                    
                    elseif($dado_recebe['tipo'] == 'busca_nome'):

                        $nome = strval($form['nome']);

                        echo "nome: ". $nome."<br>";
                        $db->query("SELECT * FROM pedidos WHERE cliente LIKE '%$nome%' ORDER BY id_ped DESC");

                        foreach($db->resultados() as $result):
                          
                        ?>
                        
                        <div class="card alert alert-primary">
                                <div class="card-body">
                                    <p class="card-text"><strong class="badge badge-success">ID Pedido: <?= $result->id_ped ?></strong></p>
            
                                        <h3 class="card-title">Resumo do Pedido</h3>
                                        <hr>
                                        <p class="card-text"> <strong>Nome: <?= $result->cliente ?> </strong> </p>
            
                                        <?php
                                            //ESSE TRECHO DE CÓDIGO É RESPONSÁVEL POR LISTAR TODOS OS PRODUTOS QUE O CLIENTE COMPROU COM AS SUAS RESPECTIVAS QUANTIDADES
            
                                            //acessa o banco de dados
                                            
                                            $db->query("SELECT * FROM pedidos_produtos WHERE id_ped = $result->id_ped");
            
                                            $id_atual = 0;
                                            
                                            
                                            foreach($db->resultados() as $produto):
                                                $nome_produto;//essa variavel recebe o nome dos produtos do pedido
            
                                                $produto_completo = "";//essa variavel fica responsável em receber todo o nome do produto e sua quantidade para ser exibido no final
            
                                                
                                                //nesse trecho é verificado se a variavel $id_atual é diferente da $produto->id_prod, pq no final dessa condição eu coloco o id que eu usei para contar a quantidade do produto na variavel $id_atual, portanto se essa der true quer dizer que eu posso contar um produto diferente, é um complicado mesmo, eu demorei para desenvolver essa lógica, talvez se eu tivesse feito de outra forma seria mais fácil, mas assim pelo menos ta funcionando (risos)
                                                if($id_atual != $produto->id_prod):
                                                    $valor_total = $produto->valor;
            
                                                    //busca todas as linhas que atendam as condições da id_ped e id_prod
                                                    $db->query("SELECT * FROM pedidos_produtos WHERE id_ped = $result->id_ped AND id_prod = $produto->id_prod");
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
                                        

                                        //trecho responsavel por trazer a data e hora do pedido cliente direto do banco de dados
                                        echo "<div class='badge badge-success text-left'>";
                                        echo "<b>Data Pedido:</b> ".date("d/m/Y", strtotime($produto->data_pedido))."<br>";
                                        date_default_timezone_set("America/Sao_Paulo");
                                        echo "<b>Hora:</b> ".date("H:i", strtotime($produto->data_pedido));
                                        echo "</div>";

                                        echo " <hr> <strong>valor: ". $valor_total. "</strong><br>";
                                        ?>
                                            
            
                                       
                                       
                                    
                                </div>
                            </div>

                        <?php

                        endforeach;
    //******************** Fim do trecho que pesquisa por nome ********************************** */





    // **************************** caso a pesquisa seja por data ****************************/

                    elseif($dado_recebe['tipo'] == 'busca_data'):
                        echo "tipo busca: ".$dado_recebe['tipo'];

                        $data_ini = trim($form['data-inicio']);
                        $data_end = trim($form['data-fim']);

                        
                        echo "<br>Data inicio: ".$data_ini."<br>";
                        echo "Data FIM: ".$data_end."<br>";
                        $db->query("SELECT * FROM pedidos_produtos WHERE data_pedido 
                        BETWEEN ('$data_ini') AND ('$data_end')");


                        foreach($db->resultados() as $pedidos):
                            $valor_total;
                            $id = $pedidos->id_ped;

                            $db_nome = new Database();
                            $db_nome->query("SELECT cliente FROM pedidos WHERE id_ped = $pedidos->id_ped");

                            foreach($db_nome->resultados() as $cliente)
                        ?>
            
                        <div class="card alert alert-primary">
                                <div class="card-body">
                                    <p class="card-text"><strong class="badge badge-success">ID Pedido: <?= $pedidos->id_ped ?></strong></p>
            
                                        <h3 class="card-title">Resumo do Pedido</h3>
                                        <hr>
                                        <p class="card-text"> <strong>Nome: <?= $cliente->cliente ?> </strong> </p>
            
                                        <?php
                                            //ESSE TRECHO DE CÓDIGO É RESPONSÁVEL POR LISTAR TODOS OS PRODUTOS QUE O CLIENTE COMPROU COM AS SUAS RESPECTIVAS QUANTIDADES
            
                                            //acessa o banco de dados
                                            
                                            $db->query("SELECT * FROM pedidos_produtos WHERE id_ped = $pedidos->id_ped");
            
                                            $id_atual = 0;
                                            
                                            
                                            foreach($db->resultados() as $produto):
                                                $nome_produto;//essa variavel recebe o nome dos produtos do pedido
            
                                                $produto_completo = "";//essa variavel fica responsável em receber todo o nome do produto e sua quantidade para ser exibido no final
            
                                                
                                                //nesse trecho é verificado se a variavel $id_atual é diferente da $produto->id_prod, pq no final dessa condição eu coloco o id que eu usei para contar a quantidade do produto na variavel $id_atual, portanto se essa der true quer dizer que eu posso contar um produto diferente, é um complicado mesmo, eu demorei para desenvolver essa lógica, talvez se eu tivesse feito de outra forma seria mais fácil, mas assim pelo menos ta funcionando (risos)
                                                if($id_atual != $produto->id_prod):
                                                    $valor_total = $produto->valor;
            
                                                    //busca todas as linhas que atendam as condições da id_ped e id_prod
                                                    $db->query("SELECT * FROM pedidos_produtos WHERE id_ped = $pedidos->id_ped AND id_prod = $produto->id_prod");
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
                                        

                                        //trecho responsavel por trazer a data e hora do pedido cliente direto do banco de dados
                                        echo "<div class='badge badge-success text-left'>";
                                        echo "<b>Data Pedido:</b> ".date("d/m/Y", strtotime($produto->data_pedido))."<br>";
                                        date_default_timezone_set("America/Sao_Paulo");
                                        echo "<b>Hora:</b> ".date("H:i", strtotime($produto->data_pedido));
                                        echo "</div>";

                                        echo " <hr> <strong>valor: ". $valor_total. "</strong><br>";
                                        ?>
                                            
            
                                       
                                       
                                    
                                </div>
                            </div>
            
                        <?php
            
                            endforeach;

    // ****************************  Fim da pesquisa por data  ************************************



    //*********************** caso o usuário selecione a opção listar ************************ */
                    elseif($dado_recebe['tipo'] == 'listar'):
                        
                        $limit = intval($form['listar']);
                        
                        $db->query("SELECT * FROM pedidos ORDER BY id_ped DESC LIMIT $limit");
    //******************** fim de caso o usuário selecione a opção listar *************** */                



    //********************** caso o submit nao tenha ou tenha outro valor diferente ************ */
                    else:
                        echo "<h3 class='text-center'>Nada foi encontrado</h3>";
                    endif;

    //************* caso o formulário não seja setado *************************************
                else:
                    $db = new Database();
                    $db->query("SELECT * FROM pedidos ORDER BY id_ped DESC LIMIT 10");
                endif;

                foreach($db->resultados() as $pedidos):
                $valor_total;
                $id = $pedidos->id_ped;
            ?>

            <div class="card alert alert-primary">
                    <div class="card-body">
                        <p class="card-text"><strong class="badge badge-success">ID Pedido: <?= $pedidos->id_ped ?></strong></p>

                            <h3 class="card-title">Resumo do Pedido</h3>
                            <hr>
                            <p class="card-text"> <strong>Nome: <?= $pedidos->cliente ?> </strong> </p>

                            <?php
                                //ESSE TRECHO DE CÓDIGO É RESPONSÁVEL POR LISTAR TODOS OS PRODUTOS QUE O CLIENTE COMPROU COM AS SUAS RESPECTIVAS QUANTIDADES

                                //acessa o banco de dados
                                
                                $db->query("SELECT * FROM pedidos_produtos WHERE id_ped = $pedidos->id_ped");

                                $id_atual = 0;
                                
                                
                                foreach($db->resultados() as $produto):
                                    $nome_produto;//essa variavel recebe o nome dos produtos do pedido

                                    $produto_completo = "";//essa variavel fica responsável em receber todo o nome do produto e sua quantidade para ser exibido no final

                                    
                                    //nesse trecho é verificado se a variavel $id_atual é diferente da $produto->id_prod, pq no final dessa condição eu coloco o id que eu usei para contar a quantidade do produto na variavel $id_atual, portanto se essa der true quer dizer que eu posso contar um produto diferente, é um complicado mesmo, eu demorei para desenvolver essa lógica, talvez se eu tivesse feito de outra forma seria mais fácil, mas assim pelo menos ta funcionando (risos)
                                    if($id_atual != $produto->id_prod):
                                        $valor_total = $produto->valor;

                                        //busca todas as linhas que atendam as condições da id_ped e id_prod
                                        $db->query("SELECT * FROM pedidos_produtos WHERE id_ped = $pedidos->id_ped AND id_prod = $produto->id_prod");
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
                            
                            //trecho responsavel por trazer a data e hora do pedido cliente direto do banco de dados
                            echo "<div class='badge badge-success text-left'>";
                            echo "<b>Data Pedido:</b> ".date("d/m/Y", strtotime($produto->data_pedido))."<br>";
                            date_default_timezone_set("America/Sao_Paulo");
                            echo "<b>Hora:</b> ".date("H:i", strtotime($produto->data_pedido));
                            echo "</div>";

                            echo " <hr> <strong>valor: ". $valor_total. "</strong><br>";
                            ?>
                                

                           
                           
                        
                    </div>
                </div>

            <?php

                endforeach;

            ?>

        </div>
    </div>
</div>