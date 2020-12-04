<?php include APP.'/views/header.php'; ?>

<div class="container" style="margin-top: 15vh; padding-top: 15vh; padding-bottom: 20vh;">
    <div class="row">
        <div class="col-12 text-center">

            <h3 class="alert <?= $dados['alert'] ?>"><?= $dados['text'] ?></h3>
            <br>
            <a href="<?=URL?>user/controle" class="btn btn-primary">
                Voltar aos pedidos
            </a>

        </div>
    </div>
</div>