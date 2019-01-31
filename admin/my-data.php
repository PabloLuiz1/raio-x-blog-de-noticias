<!DOCTYPE HTML>
<?php 
    require '../php/validarSessaoAdmin.php';
    require '../controller/ControllerUser.php';

    $conexao = abrirConexao();
    $editou = "a";
    $eu = consultarEu();
    foreach ($eu as $u){
        $nome = $u['nome'];
        $email = $u['email'];
        $whatsapp = $u['whatsapp'];
        $login = $u['login'];
        $senha = $u['senha'];
    }

    if (isset($_POST['salvar'])){
        $usuario = array(
            'id' => $_SESSION['id'],
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'whatsapp' => $_POST['whatsapp'],
            'login' => $_SESSION['login']
        );
        $editou = editar($usuario);
    }

    $ehasenhaatual = false;
    if (isset($_POST['alterar'])){
        if ($senha == md5($_POST['senhaatual'])){
            $usuario = array(
                'id' => $_SESSION['id'],
                'senha' => md5($_POST['confirmarsenha'])
            );
            $ehasenhaatual = true;
            if (strlen(editarSenha($usuario))){
                $_SESSION['senha'] = $_POST['confirmarsenha'];
                echo ("<script> alert ('Senha alterada com sucesso.'); location = location; </script>");
            }
            else{
                echo ("<script> alert('erro');</script>");
            }
        }
        else{
            echo ('<script> alert ("Erro ao autenticar a senha atual. Tente novamente."); </script>');
            $ehasenhaatual = false;
        }
    }
    fecharConexao($conexao);
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>BlogDeNoticias | Meus dados</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
        <link rel="stylesheet" href="../css/style-sidebar-dropdown.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/png" href="../images/favicon.png"/>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function validarSenhaNova(senha){
                if (senha.length > 0 && senha.length < 6){
                    document.getElementById('errosenha').classList.remove('d-none');
                    document.getElementById('errosenha').classList.add('d-block');
                    document.getElementById('confirmarsenha').value = '';
                    document.getElementById('confirmarsenha').disabled = true;
                    return false;
                }
                else if (senha.length == 0){
                    document.getElementById('errosenha').classList.remove('d-block');
                    document.getElementById('errosenha').classList.add('d-none');
                    document.getElementById('erroconfirmarsenha').classList.remove('d-block');
                    document.getElementById('erroconfirmarsenha').classList.add('d-none');
                    document.getElementById('confirmarsenha').value = '';
                    document.getElementById('confirmarsenha').disabled = true;
                    return false;
                }
                else{
                    document.getElementById('errosenha').classList.remove('d-block');
                    document.getElementById('errosenha').classList.add('d-none');
                    document.getElementById('confirmarsenha').disabled = false;
                    return true;
                }
                return true;
            }

            function validarConfirmacaoSenha(senha, confirmarsenha){
                if (validarSenhaNova(senha) == true){
                    if (senha != confirmarsenha)
                    {
                        document.getElementById('erroconfirmarsenha').classList.remove('d-none');
                        document.getElementById('erroconfirmarsenha').classList.add('d-block');
                        document.getElementById('alterar').disabled = true;
                        return false;
                    }
                    else{
                        document.getElementById('erroconfirmarsenha').classList.remove('d-block');
                        document.getElementById('erroconfirmarsenha').classList.add('d-none');
                        document.getElementById('alterar').disabled = false;
                        return true;
                    }
                }
                else{
                    document.getElementById('erroconfirmarsenha').classList.remove('d-block');
                    document.getElementById('erroconfirmarsenha').classList.add('d-none');
                }
                return false;
            }

            function validarFormulario(){
                if (document.getElementById('erroconfirmarsenha').classList.contains('d-block') || 
                document.getElementById('errosenha').classList.contains('d-block')){
                    
                }
            }


        </script>
    </head>
<body>
    <div class="container-fluid p-0">
        <header>
        <nav style="margin-top: 0%;" class="pt-0 pb-0 navbar navbar-expand-sm bg-gray navbar-light justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item border-right border-secondary pr-2" style="line-height: 250%;">Olá, <?php echo $nome; ?> </li>
                    <li class="nav-item border-right border-secondary">
                    <a class="nav-link" href="index.php">Início</a>
                    </li>
                    <li class="nav-item border-right border-secondary">
                        <a class="nav-link" href="users.php">Usuários</a>
                    </li>
                    <li class="nav-item border-right border-secondary">
                        <a class="nav-link" href="new-post.php">Postar</a>
                    </li>
                    <li class="nav-item active border-right border-secondary">
                    <a class="nav-link" href="#">Meus dados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../php/logout.php">Logout</a>
                    </li>
                </ul>
                    <figure class="float-left p-0 mx-auto figure-header">
                        <a href="index.php">
                            <img src="../images/logo.png" class="img-responsive">
                        </a>
                    </figure>
                    <form class="form-inline pull-right" action="/action_page.php">
                        <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar notícias" required>
                        <button class="btn btn-primary font-weight-bold" type="submit">Pesquisar <i class="fa fa-search fa-sm"></i></button>
                    </form>
            </nav>
        </header>
            <div class="col-md-6 float-left mt-2 ml-5 pr-0">
                <h3 class="col-md-12">Meus dados <i class="fa fa-user-circle fa-md"></i></h3>
                <form class="form-postar border-right border-secondary pr-5" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group col-md-8">
                        <label for="nome">Nome: </label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome;?>" required>
                        <label for="email">E-mail: </label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $email;?>" required>
                        <label for="whatsapp">WhatsApp: </label>
                        <input type="text" class="form-control  mb-3" id="whatsapp" name="whatsapp" placeholder="WhatsApp" value="<?php echo $whatsapp;?>" required>
                        <div id="erro" class="d-none mx-auto col-sm-12 alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $editou; ?>
                        </div>
                        <input type="submit" id="salvar" name="salvar" class="btn btn-success pull-right font-weight-bold mb-5" value="Salvar">
                        <button type="button" id="cancelar" class="btn btn-danger pull-left font-weight-bold">Cancelar</button>
                    </div>
                </form>
            </div>
            <?php 
                if (strlen($editou) == 0 && isset($_POST['salvar'])){
                    echo ("<script>alert ('Seus dados foram atualizados com sucesso.'); location.href='my-data.php';</script>");
                }
                if (strlen($editou) > 0 && isset($_POST['salvar'])){
                    echo ("<script> 
                    document.getElementById('erro').classList.remove('d-none');
                    document.getElementById('erro').classList.add('d-block');
                    </script>");
                }
            ?>
            <div class="col-md-5 float-left pl-0 mt-5">
                <form onsubmit="validarFormulario()" class="form-postar border-left border-secondary pl-5" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group col-md-10">
                        <label for="usuario">Usuário: </label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" value="<?php echo $login;?>" required disabled>
                        <label for="senhaatual">Senha atual: </label>
                        <input type="password" class="form-control" id="senhaatual" name="senhaatual" placeholder="Insira sua senha atual" required>
                        <label for="senhanova">Nova senha: </label>
                        <input type="password" onkeyup="validarSenhaNova(this.value)" class="form-control" id="senhanova" name="senhanova" placeholder="Insira a nova senha" required>
                        <div id="errosenha" class="d-none mt-2 col-sm-12 alert alert-danger">
                            A senha precisa ter no mínimo 6 caracteres.
                        </div>
                        <label for="confirmarsenha">Confirmar senha: </label>
                        <input type="password" onkeyup="validarConfirmacaoSenha(document.getElementById('senhanova').value, this.value)" class="form-control mb-3" id="confirmarsenha" name="confirmarsenha" placeholder="Insira novamente a nova senha" required disabled>
                        <div id="erroconfirmarsenha" class="d-none mt-2 col-sm-12 alert alert-danger">
                            Confirme corretamente a nova senha.
                        </div>
                        <input type="submit" id="alterar" name="alterar" class="btn btn-success pull-right font-weight-bold mb-5" value="Alterar" disabled>
                    </div>
                </form>
            </div>
            <?php 
            ?>
            <br><br><br><br><br><br><br><br><br><br><br>            <br><br><br><br><br><br><br><br><br><br><br>
        <footer>
        <div class="row">
                <div class="col-sm-4 col-footer">
                    <a href="index.php">
                        <img src="../images/logotipo.png" class="img-responsive"> Tribuna Direta
                    </a>
                </div>
                <div class="col-sm-4 col-footer"><a href="#" target="_blank" title="Página oficial no Facebook" alt="Link externo que redireciona a pagina oficial no Facebook do BlogDeNoticias"><i class="fab fa-facebook fa-lg"></i> Blog de Notícias</a>
                </div>
                <div class="col-sm-4 col-footer"><a href="mailto:contato@blogdenoticias.com" target="_blank" title="E-mail para contato" alt="Link externo que aciona a ação de enviar e-mail">
                    <i class="fa fa-envelope fa-lg"></i>contato@blogdenoticias.com</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-footer"><a href="callto:+5511912345678" target="_blank" title="WhatsApp para contato" alt="Link externo que aciona a ação de adicionar contato">
                    <i class="fab fa-whatsapp-square fa-lg"></i>+55 11 91234-5678</a></div>
                <div class="col-sm-4 col-footer"> <a href="#" target="_blank" title="Canal no YouTube" alt="Link externo que redireciona ao canal do YouTube do BlogDeNoticias">
                    <i class="fab fa-youtube fa-lg"></i>/blogdenoticias</a>
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
                <div class="col-sm-3"><span class="copyright">Tribuna Direta, a notícia do jeito certo, 2019.
                    <i class="fa fa-copyright fa-lg"></i></span></div>
            </div>
        </footer>
    </div>
</body>