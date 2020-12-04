<?php
include '../app/views/header.php';
?>


<div class="col-xl-4 col-md-6 mx-auto p-5" style="margin-top: 10vh;">

<div class="card">

    <div class="card-body">
        <?= Sessao::msg('usuario') ?>
        <h2>Logar</h2>
    
        <form action="<?=URL?>login/logar" name="" method="POST">
        
            <div class="form-group">
                <label for="nome">Nome: <sup class="text-danger">*</sup> </label>
                <input type="text" name="nome" id="email" value="<?= $dados['nome'] ?>" class="form-control <?= $dados['nome_erro'] ? 'is-invalid' : '' ?>">
                <span class="invalid-feedback">
                    <?= $dados['nome_erro'] ?>
                </span>
            </div>

            <div class="form-group">
                <label for="senha">Senha: <sup class="text-danger">*</sup> </label>
                <input type="password" name="senha" id="senha" value="<?= $dados['senha'] ?>" class="form-control <?= $dados['senha_erro'] ? 'is-invalid' : '' ?>">
                <span class="invalid-feedback">
                    <?= $dados['senha_erro'] ?>
                </span>
            </div>

            <div class="row">
                <div class="col">
                    <input class="btn btn-info btn-block" type="submit" value="Entrar">
                </div>
                
            </div>

        </form>

    </div>

</div>

</div>