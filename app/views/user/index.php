<div class="container" style="margin-top: 10vh;">

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

            <!-- Modal -->
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
            
        </div>
    
       
    
    </div>

    <div class="row">

        <?php

            $db = new Database();

            $db->query("SELECT * FROM produtos");
            
            foreach($db->resultados() as $produto):
                
        ?>
            <!-- Esse trexo fica todos os produtos cadastrados-->
            <div class="col-md-4">
            
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?= '../public/'.$produto->imagem ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $produto->nome ?></h5>
                    <p class="card-text"><?= $produto->descricao ?></p>
                    <p class="card-title">R$ <?= $produto->preco ?></p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            </div>

        <?php
            
            endforeach;
        ?>

    </div>

</div>