<!DOCTYPE HTML>
<?php 
    require 'php/gerenciaBd.php';
    require 'php/conexao.php';
    $usuario = false;
    if (isset($_POST ['logar'])){
        $login = $_POST['login'];
        $senha = md5($_POST['senha']);
        $conexao = abrirConexao();
        $usuario = select('usuario', "login = '$login' AND senha = '$senha'");
        if ($usuario){
            foreach ($usuario as $u){
                $nome = $u['nome'];
                $id = $u['id'];
                $admin = $u['admin'];
            }
            $dados = array(
                        'login' => $login,
                        'senha' => $senha,
                        'nome' => $nome,
                        'id' => $id,
                        'admin' => $admin
                    );
            session_start();
            $_SESSION['login'] = $dados['login'];
            $_SESSION['senha'] = $dados['senha'];
            $_SESSION['nome'] = $dados['nome'];
            $_SESSION['id'] = $dados['id'];
            if ($admin == 1){
                $_SESSION['admin'] = $dados['admin'];
                header ("Location: admin/index.php");
            }   
            else{
                header ("Location: user/index.php");
            }
        }
        fecharConexao($conexao);
    }
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Raio-X | Logar</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
<body>
    <div class="container-fluid p-0">
        <header>
        <nav style="margin-top: 0%;" class="pt-0 pb-0 navbar navbar-expand-sm bg-gray navbar-light justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" href="index.php">Início</a>
                    </li>
                    
                    <li class="nav-item">
                    <a class="nav-link" href="about.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contato</a>
                    </li>
                    
                </ul>
                <figure class="float-left p-0 mx-auto figure-header">
                    <a href="index.php">
                        <img src="images/logo.jpeg" class="img-responsive">
                    </a>
                </figure>
                    <form class="form-inline pull-right" action="/action_page.php">
                    <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar notícias" required>
                    <button class="btn btn-primary font-weight-bold" type="submit">Pesquisar <i class="fa fa-search fa-sm"></i></button>
                </form>
            </nav>
        </header>
        <div class="container-fluid min-height-486">
            <div class="col-md-1 float-left mt-2 ml-4 mr-3"></div>
            <div class="col-md-3 float-left mt-2 p-0">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-login" method="POST">
                    <div class="title-form-login">
                        Login
                    </div>
                    <div class="form-group" style="padding-left: 20%; padding-right: 20%; padding-top: 5%;">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="login" class="form-control" placeholder="Login" required>
                        </div>
                    </div>
                    <div class="form-group" style="padding-left: 20%; padding-right: 20%;">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                        </div>
                    </div>
                    <div id="logininvalido" class="d-none mx-auto col-sm-8 alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Login ou senha inválidos.
                    </div>
                    <div class="form-group" style="padding-left: 17%; padding-right: 17%;">
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-success pull-right mb-4 font-weight-bold" name="logar" value=" Logar ">
                            <a href="forgot-password.php">Esqueci minha senha</a><br>
                        </div>
                    </div>
                </form>
            </div>
            <?php 
                if (!$usuario && isset($_POST['logar'])){
                    $_POST['login'] = null;
                    $_POST['senha'] = null;
                    echo ("<script> 
                    document.getElementById('logininvalido').classList.remove('d-none');
                    document.getElementById('logininvalido').classList.add('d-block');
                    </script>");
                }
            ?>
        </div>
        <footer>
        <div class="row">
                <div class="col-sm-4 col-footer">
                    <a href="index.php">
                        <img src="images/logotipo.jpeg" class="img-responsive"> Raio-X
                    </a>
                </div>
                <div class="col-sm-4 col-footer"><a href="#" target="_blank" title="Página oficial no Facebook" alt="Link externo que redireciona a pagina oficial no Facebook do Raio-X"><i class="fab fa-facebook fa-lg"></i> Blog de Notícias</a>
                </div>
                <div class="col-sm-4 col-footer"><a href="mailto:contato@raio-x.com" target="_blank" title="E-mail para contato" alt="Link externo que aciona a ação de enviar e-mail">
                    <i class="fa fa-envelope fa-lg"></i>contato@raio-x.com</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-footer"><a href="callto:+5511912345678" target="_blank" title="WhatsApp para contato" alt="Link externo que aciona a ação de adicionar contato">
                    <i class="fab fa-whatsapp-square fa-lg"></i>+55 11 91234-5678</a></div>
                <div class="col-sm-4 col-footer"> <a href="#" target="_blank" title="Canal no YouTube" alt="Link externo que redireciona ao canal do YouTube do Raio-X">
                    <i class="fab fa-youtube fa-lg"></i>/Raio-X</a>
                </div>
                <div class="col-sm-4 col-footer">Newsletter - Saiba de cada postagem nova no blog:
                    <form class="form-inline newsletter" action="#">
                    <input class="form-control form-control-sm col-sm-6 mr-sm-4" type="text" placeholder="E-mail" required>
                    <button class="btn btn-sm btn-success" type="submit">Assinar</button>
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