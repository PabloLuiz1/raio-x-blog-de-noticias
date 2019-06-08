<!DOCTYPE HTML>
<?php 
    require '../controller/ControllerUser.php';
    require '../php/validarSessaoAdmin.php';
    
    $cadastrou = 0;
    $usuario;
    $conexao = abrirConexao();
    $eu = consultarEu();
    foreach ($eu as $u){
        $meunome = $u['nome'];
    }
    if (isset($_POST ['cadastrar'])){
        $usuario = array(
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'whatsapp' => $_POST['whatsapp'],
            'login' => $_POST['usuario'],
            'senha' => md5($_POST['usuario'])
        );
        $cadastrou = cadastrar($usuario);
    }
    fecharConexao($conexao);
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Raio-X | Novo usuário</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
        <link rel="stylesheet" href="../css/style-sidebar-dropdown.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/png" href="../images/favicon.png"/>
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
                <h3 class="col-md-12">Novo usuário <i class="fa fa-user-circle fa-md"></i></h3>
                <form class="form-postar" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group col-md-8">
                        <label for="nome">Nome: </label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="John Black" required>
                        <label for="email">E-mail: </label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="user@domain.com" required>
                        <label for="whatsapp">WhatsApp: </label>
                        <input type="number" max="11111111111111111" class="form-control" id="whatsapp" name="whatsapp" placeholder="+99 99 99999-9999" required>
                        <label for="usuario">Usuário: </label>
                        <input type="text" class="form-control mb-3" id="usuario" name="usuario" placeholder="johnblack" required>
                        <div id="erro" class="d-none mx-auto col-sm-12 alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $cadastrou; ?>
                        </div>
                        <div id="sucesso" class="d-none mx-auto col-sm-12 alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Usuário <strong><?php echo $usuario['nome']; ?></strong> cadastrado com sucesso.
                        </div>
                        <input type="submit" name="cadastrar" class="btn btn-success pull-right font-weight-bold mb-5" value="Cadastrar">
                        <a href="users.php" class="btn btn-primary pull-left font-weight-bold"><i class="fas fa-arrow-left"></i> Voltar</a>
                    </div>
                </form>
            </div>
            <?php 
                if (strlen($cadastrou) > 0 && isset($_POST['cadastrar'])){
                    echo ("<script> 
                    document.getElementById('erro').classList.remove('d-none');
                    document.getElementById('erro').classList.add('d-block');
                    </script>");
                }
                if (strlen($cadastrou) == 0 && isset($_POST['cadastrar'])){
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