<div class="container" style="margin-top: 80px;">

    <div class="row">
        <div class="col-12 text-center">
            <h5 class="display-4">Nosso Cardápio</h5>
        </div>
    </div>

</div>
<hr>
<div class="container">
    
    <div class="row">

        <?php

            $db = new Database();

            $db->query("SELECT * FROM produtos");
            $num_produto = 1;
            foreach($db->resultados() as $produto):
            
                
        ?>

        <div class="col-12 col-md-6" style="margin-top: 5px; margin-bottom: 5px">
            <div class="card" id="item<?= $num_produto ?>">
                <div class="row no-gutters">
                    <div class="col-sm-5">
                        <img class="card-img" src="<?= $produto->imagem ?>" alt="Suresh Dasari Card">
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title" id="add<?=$num_produto?>"><strong><?= $produto->nome ?></strong></h5>
                            <p class="card-text"><?= $produto->descricao ?></p>

                            <p>
                                <!-- Marca um sinal verde quando tem 1 ou mais ítens no carrinho -->
                                <span class="text-success" id="confirma_item<?= $num_produto?>"></span>
                                <span class="btn btn-primary" id="add_item<?= $num_produto ?>"><strong>Adicionar</strong></span>
                                R$ <strong id="preco_item<?= $num_produto ?>"><?= $produto->preco ?></strong>
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
                <script>console.log('número: ', <?= $num_produto ?>)</script>
        <?php
            $num_produto++;
            endforeach;
        ?>

    </div>
</div>
    
    <div data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-shopping-bag" style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color: #ff6600;color:#FFF;border-radius:50px;text-align:center;font-size:40px;
        z-index: 1000; padding: 5px" target="_blank">
                <span style="top: -60px; z-index: 1000000 !important" class="badge badge-pill badge-danger" id="count_cart">0</span>
        </i>
    </div>
    



<!-- *************************** aqui é formulário do carrinho ******************************* -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong>Seus pedidos</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="form">


            <!-- ************************** item do pedido ******************************* -->

            <?php

                $db = new Database();

                $db->query("SELECT * FROM produtos");
                $num_item = 1;
                foreach($db->resultados() as $produto):
                
            ?>

            <div class="form-row" id="id_form_item">
                <div class="col-6">
                    <input class="form-control" type="text" name="form_item<?= $num_item ?>" id="" value="<?= $produto->nome ?>" disabled>
                </div>

                <div class="col-2">
                    <strong id="add<?=$num_item?>">0</strong> x
                </div>
                   
                <div class="col-2">

                    <div class="btn btn-success" id="add_plus<?=$num_item?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M11.75 4.5a.75.75 0 01.75.75V11h5.75a.75.75 0 010 1.5H12.5v5.75a.75.75 0 01-1.5 0V12.5H5.25a.75.75 0 010-1.5H11V5.25a.75.75 0 01.75-.75z"></path></svg>
                    </div>
                </div>
                <div class="col-2">
                    <div class="btn btn-warning" id="add_less<?=$num_item?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M4.5 12.75a.75.75 0 01.75-.75h13.5a.75.75 0 010 1.5H5.25a.75.75 0 01-.75-.75z"></path></svg>
                    </div>
                
                </div>
            </div>
            <!-- **************************************************************************** -->
            
            <hr>

            <?php
                $num_item++;
                endforeach;
            ?>

            <hr>
            <div class="form-row">
                <label for="valor"><strong>Total R$</strong></label>
                <input class="form-control" type="text" name="valor_total" id="valor_total" value="0">
            </div>

            <div class="modal-footer">
                
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                <input type="submit" value="Confirmar" class="btn btn-primary">
            </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- ************************************************************************************************ -->