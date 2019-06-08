<!DOCTYPE HTML>
<?php 
    require '../controller/ControllerUser.php';
    require '../php/validarSessaoAdmin.php';
    
    $id = array(
        'id' => $_GET['u']
    );
    $excluiu = false;
    $conexao = abrirConexao();
    $eu = consultarEu();
    foreach ($eu as $u){
        $meunome = $u['nome'];
    }
    $usuario = consultarPorId($id);
    foreach($usuario as $u){
        $nome = $u['nome'];
        $email = $u['email'];
        $whatsapp = $u['whatsapp'];
        $login = $u['login'];
    }

    if (isset($_POST ['excluir'])){
        $usuario = array(
            'id' => $_GET['u'],
            'ativo' => 0
        );
        $excluiu = excluir($usuario);
    }
    fecharConexao($conexao);
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Raio-X | Excluir usuário</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
        <link rel="stylesheet" href="../css/style-sidebar-dropdown.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
<body>
    <div class="container-fluid p-0">
        <header>
        <nav style="margin-top: 0%;" class="pt-0 pb-0 navbar navbar-expand-sm bg-gray navbar-light justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item border-right border-secondary pr-2" style="line-height: 250%;">Olá, <?php echo $meunome; ?> </li>
                    <li class="nav-item border-right border-secondary">
                    <a class="nav-link" href="index.php">Início</a>
                    </li>
                    <li class="nav-item active border-right border-secondary">
                        <a class="nav-link" href="users.php">Usuários</a>
                    </li>
                    <li class="nav-item border-right border-secondary">
                        <a class="nav-link" href="new-post.php">Postar</a>
                    </li>
                    <li class="nav-item border-right border-secondary">
                    <a class="nav-link" href="my-data.php">Meus dados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../php/logout.php">Logout</a>
                    </li>
                </ul>
                    <figure class="float-left p-0 mx-auto figure-header">
                        <a href="index.php">
                            <img src="../images/logo.jpeg" class="img-responsive">
                        </a>
                    </figure>
                    
            </nav>
        </header>
            <div class="col-md-6 float-left mt-2 ml-5 pr-0">
                <h3 class="col-md-12">Excluir usuário <i class="fa fa-user-circle fa-md"></i></h3>
                <h3 class="col-md-12">Tem certeza que quer excluir este usuário?</h3>
                <form class="form-postar" action="delete-user.php?u=<?php echo $_GET['u'];?>" method="POST">
                    <div class="form-group col-md-8">
                        <label for="nome">Nome: </label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php  echo $nome; ?>" required disabled>
                        <label for="email">E-mail: </label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>" required disabled>
                        <label for="whatsapp">WhatsApp: </label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp" value="<?php echo $whatsapp; ?>" required disabled>
                        <label for="usuario">Usuário: </label>
                        <input type="text" class="form-control mb-3" id="usuario" name="usuario" placeholder="Usuário" value="<?php echo $login; ?>" required disabled>
                        <div id="erro" class="d-none mx-auto col-sm-12 alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $excluiu; ?>
                        </div>
                        <div id="sucesso" class="d-none mx-auto col-sm-12 alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Usuário <strong><?php echo $nome; ?></strong> excluído com sucesso.
                        </div>
                        <input type="submit" name="excluir" class="btn btn-danger pull-right font-weight-bold mb-5" value="Excluir">
                        <a href="users.php" class="btn btn-primary pull-left font-weight-bold"><i class="fas fa-arrow-left"></i> Voltar</a>
                    </div>
                </form>
            </div>
            <?php 
                if (strlen($excluiu) == false && isset($_POST['excluir'])){
                    echo ("<script> 
                    document.getElementById('erro').classList.remove('d-none');
                    document.getElementById('erro').classList.add('d-block');
                    </script>");
                }
                if (strlen($excluiu) > 0 && isset($_POST['excluir'])){
                    echo ("<script> 
                    document.getElementById('sucesso').classList.remove('d-none');
                    document.getElementById('sucesso').classList.add('d-block');
                    </script>");
                }
            ?>
            <div class="col-md-5 float-left pl-0 mt-5">
            </div>
            <br><br><br><br><br><br><br><br><br><br><br>            <br><br><br><br><br><br><br><br><br><br><br>
        <footer>
        <div class="row">
                <div class="col-sm-4 col-footer">
                    <a href="index.php">
                        <img src="../images/logotipo.jpeg" class="img-responsive"> Raio-X
                    </a>
                </div>
                <div class="col-sm-4 col-footer"><a href="#" target="_blank" title="Página oficial no Facebook" alt="Link externo que redireciona a pagina oficial no Facebook do Raio-X"><i class="fab fa-facebook fa-lg"></i> Raio-X</a>
                </div>
                <div class="col-sm-4 col-footer"><a href="mailto:contato@raio-x.com" target="_blank" title="E-mail para contato" alt="Link externo que aciona a ação de enviar e-mail">
                    <i class="fa fa-envelope fa-lg"></i>contato@raiox.com</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-footer"><a href="callto:+5511912345678" target="_blank" title="WhatsApp para contato" alt="Link externo que aciona a ação de adicionar contato">
                    <i class="fab fa-whatsapp-square fa-lg"></i>+55 11 91234-5678</a></div>
                <div class="col-sm-4 col-footer"> <a href="#" target="_blank" title="Canal no YouTube" alt="Link externo que redireciona ao canal do YouTube do Raio-X">
                    <i class="fab fa-youtube fa-lg"></i>/Raio-X</a>
                </div>
                <div class="col-sm-4 col-footer">
                </div>
            </div>
            <div class="row">
            </div>
            <div class="row">
                <div class="col-sm-4 ml-5 "></div>
                <div class="col-sm-3"><span class="copyright">Raio-X, a verdade sobre o sistema prisional brasileiro, 2019.
                    <i class="fa fa-copyright fa-lg"></i></span></div>
            </div>
        </footer>
    </div>
</body>