<?php 
include '../app/views/header-home.php';
?>

<div class="container" style="margin-top: 15vh; min-height: 50vh">

    <div class="row">
    
        <div class="col-12">

            <h3 class="alert <?= isset($dados['alert']) ? $dados['alert'] : '' ?> text-center"><?= isset($dados['text']) ? $dados['text'] : 'Nada foi enviado' ?></h3>

            <br>
        
            <header style="border-bottom:  1px solid #222;">

                <p class='text-center' style='margin-top: 10vh'><a class="btn btn-warning" href="<?=URL?>">Início</a></p>
            
            </header>
        
        </div>
    
    </div>

</div>