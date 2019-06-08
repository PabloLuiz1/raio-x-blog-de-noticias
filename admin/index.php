<!DOCTYPE HTML>
<?php 
    require '../php/validarSessaoAdmin.php';
    require '../controller/ControllerPost.php';

    $conexao = abrirConexao();
    $noticias = consultar();
    $eu = consultarEu();
    foreach ($eu as $u){
        $meunome = $u['nome'];
    }
    fecharConexao($conexao);
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Raio-X | Início</title>
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
                    <li class="nav-item active border-right border-secondary">
                    <a class="nav-link" href="#">Início</a>
                    </li>
                    <li class="nav-item border-right border-secondary">
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
            <div class="col-md-11 float-left mt-2 ml-5">
                <h3>Todas as postagens <i class="fa fa-newspaper fa-md"></i></h3>
                <a href="new-post.php" class="text-decoration-none"><button class="btn btn-sm btn-success mt-1 font-weight-bold">Nova postagem <i class="fa fa-plus fa-sm"></i></button></a>
                <form class="form-inline pull-right mt-1 mb-3 p-0 col-sm-4" action="/action_page.php">
                        <input class="form-control form-control-sm mr-sm-2 col-sm-6 ml-5" style="width: %;"type="text" placeholder="Pesquisar todas as postagens" required>
                        <button class="btn btn-sm btn-primary font-weight-bold" type="submit">Pesquisar <i class="fa fa-search fa-sm"></i></button>
                </form>
                <table class="table-bordered table-hover table text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>Título</th>
                            <th>Estado</th>
                            <th>Unidade</th>
                            <th>Data de publicação/edição</th>
                            <th>Arquivo</th>
                            <th>Autor</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (!$noticias){
                                echo ("<tr>");
                                    echo ("<td colspan=8>Não há notícias registradas.</td>");
                                echo ("</tr>");
                            }
                            else{
                                foreach($noticias as $n){
                                    $arquivo = $n['arquivo'];
                                    echo ("<tr>");
                                        echo ('<td><a target="_blank" href="../news.php?n='.$n['idnoticia'].'">'.$n['titulo'].'</a></td>');
                                        echo ("<td>".$n['estado']."</td>");
                                        echo ("<td>".$n['unidade']."</td>");
                                        echo ("<td>".$n['dat']."</td>");
                                        echo ('<td><a href="../uploaded/'.$arquivo.'" target="_blank">'.$arquivo.'</a></td>');
                                        echo ("<td>");
                                            echo ('<a href="news.php?u='.$n['idusuario'].'" title="Ver as postagens deste usuário">'.$n['nomeusuario'].' <i class="fa fa-user fa-md"></i></a>');
                                        echo ("</td>");
                                        echo ("<td>");
                                            echo('<a href="edit-post.php?p='.$n['idnoticia'].'"><i class="fa fa-edit fa-lg"></i></a>');
                                        echo ("</td>");
                                        echo ("<td>");
                                            echo ('<a href="delete-post.php?p='.$n['idnoticia'].'"><i class="fa fa-trash-alt fa-lg"></i></a>');
                                        echo("</td>");
                                    echo ("</tr>");
                                }
                            }
                        ?>
                    </tbody>
                </table>
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