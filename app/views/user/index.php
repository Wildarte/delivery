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
                            <form action="" method="post">
                            
                                <div class="form-group">
                                    <label for="nome-produto">Nome do produo</label>
                                    <input type="text" class="col-6 form-control" name="nome-produto" placeholder="Ex: Bolo de Cenoura">
                                </div>
                                <div class="form-group">
                                    <label for="descricao">Descrição do produto</label>
                                    <input type="text" class="form-control" name="descricao-produto" placeholder="Ex: Bolo de cenoura com cobertura de chocolate">
                                </div>
                                <div class="form-group">
                                <label for="preco-produto">Preço</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">R$</div>
                                        </div>
                                        <input type="text" class="col-6 form-control" name="preco-produto" placeholder="Ex: 5,00">
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="imagem-produto">Imagem do Produto</label>
                                    
                                    <input type="file" class="form-control-file" placeholder="Imagem que representa seu produto">
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-success" name="envia" value="Cadastrar">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    
       
    
    </div>

</div>