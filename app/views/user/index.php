<?php include APP.'/views/header.php'; ?>

<div class="container" style="margin-top: 15vh;">

    <div class="row">
    
        <div class="col-12">
        
            <header style="border-bottom: 1px solid black">
                <h1>Painel</h1>
                <small>Aqui ficam todos os produto que estão disponíveis no seu cardápio</small>
            </header>
        
        </div>
    
    </div>

    <div class="row my-4">

        <div class="col-12">
        
             <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary my-1" title="cadastrar novos produtos" data-toggle="modal" data-target="#exampleModal">
            Cadastrar Produto
            </button>

            <button class="btn btn-secondary my-1" title="Mensagem que é exibida quando o cliente finaliza o pedido" data-toggle="modal" data-target="#modalTitulo">Cabeçalho cardápio</button>
            
            <button class="btn btn-secondary my-1" title="Mensagem que é exibida quando o cliente finaliza o pedido" data-toggle="modal" data-target="#modalInfo">Mensagem Pedido</button>

            <button type="button" class="btn btn-secondary my-1" onclick="window.location.reload()"><i class="fas fa-redo" title="Recarrega a página"></i>
            Refresh
            </button>

            <button type="button" class="btn btn-success my-1" id="botao" title="Copiar link do cardápio">
            copiar link do cardápio
            </button>

            <input type="text" class="btn btn my-1" id="url" value="<?=URL?>">
            
            <!-- ********************** Modal para cadastro de produto **************************** -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=URL?>user/" method="post" enctype="multipart/form-data">
                            
                                <div class="form-group">
                                    <label for="nome-produto">Nome do produo</label>
                                    <input type="text" class="col-6 form-control" name="nome-produto" placeholder="Ex: Bolo de Cenoura" required>
                                    
                                </div>  
                                <div class="form-group">
                                    <label for="descricao">Descrição do produto</label>
                                    <input type="text" class="form-control" name="descricao-produto" placeholder="Ex: Bolo de cenoura com cobertura de chocolate" required>
                                </div>
                                <div class="form-group">
                                <label for="preco-produto">Preço</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">R$</div>
                                        </div>
                                        <input type="text" class="col-6 form-control" name="preco-produto" placeholder="Ex: 5,00" required>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="imagem-produto">Imagem do Produto</label>
                                    
                                    <input type="file" class="form-control-file" name="imagem-produto" placeholder="Imagem que representa seu produto">
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" name="submit" value="Cadastrar">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ********************************* Fim do Modal para Cadastro *************************** -->



            <!-- ********************** Modal para Cabeçalho do Cardápio **************************** -->
            <div class="modal fade" id="modalTitulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Aqui você configura o título e o subtítulo do cardápio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=URL?>user/cabecalho" method="post" class="form">
                            
                                <?php

                                    $db = new Database();
                                    $db->query("SELECT * FROM cardapio");
                                    foreach($db->resultados() as $cardapio):

                                    endforeach;
                                ?>
                                <div class="form-group">
                                    <label for="titulo_cardapio">Título do Cardápio</label>
                                    <input type="text" class="form-control" name="titulo_cardapio" value="<?= $cardapio->title ?>">
                                    <small class="text-muted">Esse título ficará no cabeçalho do cardápio</small>
                                </div>


                                <div class="form-group">
                                    <label for="nome-produto">Subtítulo do Cardápio</label>
                                    <textarea class="form-control" rows="5" name="subtitulo_cardapio" placeholder="Subtítulo aqui..." required><?= $cardapio->subtitle ?></textarea>
                                    <small class="text-muted">Coloque informações que possam ser importantes para que seu cliente saiba, como novos horário locais de retirada, ou alguma informação que você queira passar para o cliente antes dele efetuar o pedido</small>
                                </div>  
                               
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" name="submit" value="Confirmar">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ********************** Fim do Modal para Cabeçalho do cardápio *************************** -->



            <!-- ********************** Modal para Mensagem do Pedido **************************** -->
            <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Mensagem de confirmação do pedido</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=URL?>user/msg" method="post" class="form">
                            
                                <?php

                                    $db = new Database();
                                    $db->query("SELECT * FROM user");
                                    foreach($db->resultados() as $msg):

                                    endforeach;
                                ?>

                                <div class="form-group">
                                    <label for="nome-produto">Escreva sua mensagem</label>
                                    <textarea class="form-control" rows="5" name="msg-confirma" placeholder="Mensagem aqui..." required><?= $msg->msg ?></textarea>
                                    <small class="text-muted">Coloque informações sobre retirada do produto e/ou agradecimentos singelos ao cliente</small>
                                </div>  
                               
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" name="submit" value="Confirmar">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ********************** Fim do Modal para Mensagem do pedido *************************** -->
        </div>
    
       
    
    </div>

    <div class="row">

        <?php

            $db = new Database();

            $db->query("SELECT * FROM produtos ORDER BY id DESC");
            $num_edita_produto = 1;
            foreach($db->resultados() as $produto):
                
        ?>
            <!-- Esse trecho fica todos os produtos cadastrados-->
            <div class="col-md-4">
                
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" id="img_produto<?=$num_edita_produto?>" src="<?= URL.'public/'.$produto->imagem ?>" alt="Card image cap">
                    <div id="pega_img<?=$num_edita_produto?>" hidden><?= URL.'public/'.$produto->imagem ?></div>
                    <div class="card-body" id="card_edita_prod<?=$num_edita_produto?>">
                        <span hidden="hidden" id="id<?=$num_edita_produto?>"><?= $produto->id ?></span>
                        <h5 class="card-title" id="nome_produto_edita<?= $num_edita_produto ?>"><?= $produto->nome ?></h5>
                        <p class="card-text" id="desc_produto_edita<?= $num_edita_produto?>"><?= $produto->descricao ?></p>
                        <p>R$ <span class="card-title" id="preco_produto_edita<?=$num_edita_produto?>"><?= $produto->preco ?></span></p>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-editar-produto1" id="botao-edita-produto<?= $num_edita_produto ?>">
                        Editar
                        </button>

                    </div>
                </div>

            </div>
             
            <?php
                // *********** fim do foreach **********************
                $num_edita_produto++;
                endforeach;
            ?>


            <!-- ********************** Modal para editar ************************ -->
            <div class="modal fade" id="modal-editar-produto1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-warning text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?=URL?>user/editar/" method="post" enctype="multipart/form-data" id="form-edita-produto">
                                <input type="text" name="id_produto" value="" hidden="hidden">
                                <div class="form-group">
                                    <label for="nome-produto">Nome do produo</label>
                                    <input type="text" class="col-6 form-control" id="nome_produto_edita" name="nome-produto" value="0" placeholder="Ex: Bolo de Cenoura" required>
                                    
                                </div>  
                                <div class="form-group">
                                    <label for="descricao">Descrição do produto</label>
                                    <input type="text" class="form-control" id="descricao_form_edita" name="descricao-produto" value="0" placeholder="Ex: Bolo de cenoura com cobertura de chocolate" required>
                                </div>
                                <div class="form-group">
                                <label for="preco-produto">Preço</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">R$</div>
                                        </div>
                                        <input type="text" id="" class="col-6 form-control" id="preco_produto_edita" name="preco-produto" value="" placeholder="Coloque somente o valor" required>
                                        
                                    </div>
                                    <small id="emailHelp" class="form-text text-muted">Use ponto no lugar de vírgula, coloque somento o valor. Ex: 2.50</small>
                                </div>

                                <input type="text" name="img_prod" value="" hidden>

                                <div class="form-group">
                                    <label for="imagem-produto">Imagem do Produto</label>
                                    
                                    <input type="file" class="form-control-file" name="imagem-produto" placeholder="Imagem que representa seu produto" value="">
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" name="submit" value="Salvar">
                            <input type="submit" class="btn btn-dark" name="submit" id="" value="Excluir">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- **************************** Fim do modal para editar ******************** -->
        
    </div>

</div>