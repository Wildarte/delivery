<?php include APP.'/views/header.php'; ?>

<div class="container" style="margin-top: 15vh;">

    <div class="row">
    
        <div class="col-12">
        
            <header style="border-bottom: 1px solid black">
                <h1>Painel</h1>
            </header>
        
        </div>
    
    </div>

    <div class="row my-4">

        <div class="col-12">
        
             <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Cadastrar Produto
            </button>
            
            <button type="button" class="btn btn-secondary" onclick="window.location.reload()"><i class="fas fa-redo"></i>
            </button>
            
            <input type="button" id="url" value="https://devpleno.com" />
            <!-- ********************************** Modal para cadastro **************************** -->
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
        </div>
    
       
    
    </div>

    <div class="row">

        <?php

            $db = new Database();

            $db->query("SELECT * FROM produtos ORDER BY id DESC");
            $num_edita_produto = 1;
            foreach($db->resultados() as $produto):
                
        ?>
            <!-- Esse trexo fica todos os produtos cadastrados-->
            <div class="col-md-4">
                
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" id="img_produto<?=$num_edita_produto?>" src="<?= URL.'public/'.$produto->imagem ?>" alt="Card image cap">
                    <div id="pega_img<?=$num_edita_produto?>"><?= URL.'public/'.$produto->imagem ?></div>
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