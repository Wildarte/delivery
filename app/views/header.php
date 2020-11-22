<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="logo-painel" href="#">
    <img src="https://cdn.pixabay.com/photo/2014/04/03/10/09/place-setting-309980_960_720.png" alt="" srcset="">
  </a>
  <?php if(isset($_SESSION['user_id'])): //caso tenha a sessão exibe o menu ?>
      <h2 class="text-success" style="margin-left: 10px;">Logado <i class="fas fa-user-check"></i></h2>
      <?php endif; ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#textoNavbar" aria-controls="textoNavbar" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <?php if(isset($_SESSION['user_id'])): //caso tenha a sessão exibe o menu ?>

  <div class="collapse navbar-collapse" id="textoNavbar">
    
    <ul class="navbar-nav mr-auto" style="margin-left: 50px;">
      
      <li class="nav-item">
        <a class="nav-link text-white" href="<?=URL?>user">Cardápio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="<?=URL?>user/controle">Pedidos</a>
      </li>
    </ul>
    <span class="">
      <a class="btn btn-danger" href="<?=URL?>login/sair" class=" text-white">
        Sair <i class="fas fa-sign-out-alt"></i>
      </a>
    </span>
  </div>
  <?php endif; ?>
</nav>