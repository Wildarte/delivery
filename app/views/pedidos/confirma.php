<div class="container" style="margin-top: 10vh;">

    <div class="row">
    
        <div class="col-12">
        
            <header>
            
                <h1 class="h1 text-center alert alert-success">Pedido Confirmado!</h1>
            
            </header>

        </div>

    </div>

    <div class="row">

        <div class="col-12">

            <div class=" h3 text-center alert alert-primary">Seu Pedido foi confirmado e poderá ser retirado no restaurante Cleber hoje em até 2 horas</div>

        </div>

    </div>

    <div class="row">

        <div class="col-12">

            
                <div class="card alert alert-secondary">
                    <div class="card-body">
                        <p class="card-text"><strong>ID Pedido: <?= $dados['id_pedido'] ?></strong></p>
                        <h3 class="card-title">Resumo do Pedido</h3>
                        
                        <p class="card-text"> <strong>Nome: <?= $dados['nome'] ?> </strong> </p>

                        <?php
                            $db = new Database();
                            $db->query("SELECT id_prod FROM pedidos_produtos WHERE id_ped = ".$dados['id_pedido']."");
                            foreach($db->resultados() as $produto):
                                
                                $db2 = new Database();
                                $db2->query("SELECT id_prod FROM pedidos_produdos WHERE id_prod = $produto->id_prod AND id_ped = ".$dados['id_pedido']."");
                                $conta_itens = 0;

                                foreach($db2->resultados() as $item):

                                    $conta_itens++;

                                endforeach;
                        ?>
                                
                        <?php
                            endforeach;
                        ?>
                            
                        
                            <p class="card-text"><?= $conta_itens ?>x</p>

                    <hr>
                    <p class="card-text"> <strong> Total: <?= $dados['valor_total'] ?> </strong> </p>
                </div>
            </div>
            <p>
                <button type="button" name="" id="" class="btn btn-primary">Salvar Comprovante</button>
                <a href="<?=URL?>" name="" id="" class="btn btn-warning">Voltar ao início</a>
            </p>

        </div>
        </div>
    </div>
    </div>
</div>