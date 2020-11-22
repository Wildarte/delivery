
<div class="col-xl-4 col-md-6 mx-auto p-5" style="margin-top: 10vh;">

    <div class="card">
    
        <div class="card-body">
            <h2>Cadastre-se</h2>
            <small>Preencha o formulário abaixo</small>

            <form action="<?=URL?>login/cadastrar" name="" method="POST">
            
                <div class="form-group">
                    <label for="nome">Nome: <sup class="text-danger">*</sup> </label>
                    <input type="text" name="nome" id="nome" value="<?= $dados['nome'] ?>" class="form-control <?= $dados['nome_erro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $dados['nome_erro'] ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">E-mail: <sup class="text-danger">*</sup> </label>
                    <input type="text" name="email" id="email" value="<?= $dados['email'] ?>" class="form-control <?= $dados['email_erro'] ? 'is-invalid' : '' ?>">
                    <span class="invalid-feedback">
                        <?= $dados['email_erro'] ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="senha">Senha: <sup class="text-danger">*</sup> </label>
                    <input type="password" name="senha" id="senha" value="<?= $dados['senha'] ?>" class="form-control <?= $dados['senha_erro'] ? 'is-invalid' : '' ?>">
                    <span class="invalid-feedback">
                        <?= $dados['senha_erro'] ?>
                    </span>
                </div>
                
                <div class="form-group">
                    <label for="confirma_senha">Confirma Senha: <sup class="text-danger">*</sup> </label>
                    <input type="password" name="confirma_senha" id="confrima_senha" value="<?= $dados['confirma_senha'] ?>" class="form-control <?= $dados['confirma_senha_erro'] ? 'is-invalid' : '' ?>">
                    <span class="invalid-feedback">
                        <?= $dados['confirma_senha_erro'] ?>
                    </span>
                </div>

                <div class="row">
                    <div class="col">
                        <input class="btn btn-info btn-block" type="submit" value="cadastrar">
                    </div>
                    <div class="col">
                        Você tem uma conta? <a href="#">Faça Login</a>
                    </div>
                </div>

            </form>

        </div>
    
    </div>

</div>