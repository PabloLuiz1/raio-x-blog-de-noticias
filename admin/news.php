<!DOCTYPE HTML>
<?php
    require '../php/data-manager.php';
    require '../php/validarSessaoAdmin.php';
    require '../controller/ControllerUser.php';

    $conexao = abrirConexao();
    $eu = consultarEu();
    foreach ($eu as $u){
        $meunome = $u['nome'];
    }
    $numeromeses = array (
        1 => selectQtdPorMes('2019', '1')['total'],
        selectQtdPorMes('2019', '2')['total'],
        selectQtdPorMes('2019', '3')['total'],
        selectQtdPorMes('2019', '4')['total'],
        selectQtdPorMes('2019', '5')['total'],
        selectQtdPorMes('2019', '6')['total'],
        selectQtdPorMes('2019', '7')['total'],
        selectQtdPorMes('2019', '8')['total'],
        selectQtdPorMes('2019', '9')['total'],
        selectQtdPorMes('2019', '10')['total'],
        selectQtdPorMes('2019', '11')['total'],
        selectQtdPorMes('2019', '12')['total']
    );


    if (isset($_GET['u'])){
        $noticias = selectNoticia('tbnoticia.ativo = 1 AND autor = '.$_GET['u']);
        foreach ($noticias as $n){
            $datapublicacao = $n['dat'];
            $titulo = $n['titulo'];
            $resumo = $n['resumo'];
            $tema = $n['tema'];
            $imagem = $n['imagem'];
            $arquivo = $n['arquivo'];
            $video = $n['video'];
            $autor = $n['nomeusuario'];
        }
    }
    $noticias;
    $mes;
    if (isset($_GET['a']) && isset($_GET['m'])){
        $mes = nomeDoMes($_GET['m']);
        if (isset($_GET['t'])){
            $noticias = selectNoticiasPorMes($_GET['a'], $_GET['m'], "tbnoticia.tema = '".$_GET['t']."'");
            $numeromeses = array (
                1 => selectQtdPorMes('2019', '1', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '2', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '3', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '4', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '5', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '6', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '7', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '8', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '9', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '10', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '11', "tema = '".$_GET['t']."'")['total'],
                selectQtdPorMes('2019', '12', "tema = '".$_GET['t']."'")['total']
            );
        }
        else
            $noticias = selectNoticiasPorMes($_GET['a'], $_GET['m']);
    }
    fecharConexao($conexao);
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>BlogDeNoticias | Notícias</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
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
                            <img src="../images/logo.png" class="img-responsive">
                        </a>
                    </figure>
                    <form class="form-inline pull-right" action="/action_page.php">
                        <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar notícias" required>
                        <button class="btn btn-primary font-weight-bold" type="submit">Pesquisar <i class="fa fa-search fa-sm"></i></button>
                    </form>
            </nav>
        </header>
        <div class="col-md-8 float-left mt-2 ml-4 mr-3">
                    <?php if (isset($_GET['n'])){
                        echo ('<h2 class="col-md-12 border-bottom border-secondary">'.$titulo.'</h2>
                        '.$resumo.'
                        <iframe class="frame-noticia mx-auto" src="uploaded/'.$arquivo.'"></iframe>
                        <h4 class="col-md-12 border-bottom border-secondary">Vídeo: </h4>
                        <iframe class="frame-video" width="560" height="315" src="'.$video.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <span class="calibri-12"><strong>Publicado por: </strong>'.$autor.'. <br><strong>Data da publicação:</strong> '.$datapublicacao.'
                        </span><hr>');
                    }
                    if (isset($_GET['a']) && isset($_GET['m'])){
                        if (isset($_GET['t']))
                            echo ('<h2 class="col-md-12 border-bottom border-secondary">'.$_GET['t'].' - Notícias de '.$mes.'/'.$_GET['a'].'</h2>');
                        else
                            echo ('<h2 class="col-md-12 border-bottom border-secondary">Notícias de '.$mes.'/'.$_GET['a'].'</h2>');
                        if (!$noticias){
                            echo ('Não há notícias neste período.');
                        }
                        else{
                            echo ('<ul class="nav nav-pills">');
                            foreach ($noticias as $n){
                                echo ('<div class="col-md-4 float-left calibri-12">');
                                    echo ('<div class="nav-item mb-5 p-0">');
                                        echo ('<a class="nav-link text-center p-0r" href="news.php?n='.$n['idnoticia'].'" title="Ver a postagem">');
                                            echo ('<img class="img-fluid rounded" src="uploaded/'.$n['imagem'].'">');
                                            echo ($n['titulo']);
                                        echo ('</a>');
                                        echo ('<strong>Tema: </strong> '.$n['tema'].'<br> <strong>Autor: </strong>'.$n['nomeusuario'].' 
                                        <br> <strong>Publicação: </strong>'.$n['dat'].'
                                        <br> <a class="p-0 nav-link text-center" href="news.php?n='.$n['idnoticia'].'#comments" title="Ver os comentários desta postagem">
                                        <strong>Comentários <i class="fa fa-comment fa-sm"></i></strong></a>');
                                    echo ('</div>');
                                echo ('</div>');
                            }
                            echo ('</ul>');
                        }   
                    }

                    if (isset($_GET['u'])){
                        echo ('<h2 class="col-md-12 border-bottom border-secondary">Notícias publicadas por '.$autor.' </h2>');
                        echo ('<ul class="nav nav-pills">');
                            foreach ($noticias as $n){
                                echo ('<div class="col-md-4 float-left calibri-12">');
                                    echo ('<div class="nav-item mb-5 p-0">');
                                        echo ('<a class="nav-link text-center p-0r" href="../news.php?n='.$n['idnoticia'].'" title="Ver a postagem">');
                                            echo ('<img class="img-fluid rounded" src="../uploaded/'.$n['imagem'].'">');
                                            echo ($n['titulo']);
                                        echo ('</a>');
                                        echo ('<strong>Tema: </strong> '.$n['tema'].'<br> <strong>Autor: </strong>'.$n['nomeusuario'].' 
                                        <br> <strong>Publicação: </strong>'.$n['dat'].'
                                        <br> <a class="p-0 nav-link text-center" href="../news.php?n='.$n['idnoticia'].'#comments" title="Ver os comentários desta postagem">
                                        <strong>Comentários <i class="fa fa-comment fa-sm"></i></strong></a>');
                                    echo ('</div>');
                                echo ('</div>');
                            }
                            echo ('</ul>');
                    }
                    ?>
                    </div>
                </div>
                <div class="col-md-3 float-left mt-2 p-0 ml-5">
                    <h3>Arquivo</h3>
                    <div id="accordion">
                            <div class="card">
                            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                <div class="card-header">
                                    2019    
                                </div>
                            </a>
                            <div id="collapseOne" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <ul class="list-group ">
                                    <?php 
                                            $nomemeses = array (
                                                1 => 'Janeiro',
                                                'Fevereiro',
                                                'Março',
                                                'Abril',
                                                'Maio',
                                                'Junho',
                                                'Julho',
                                                'Agosto',
                                                'Setembro',
                                                'Outubro',
                                                'Novembro',
                                                'Dezembro'
                                            );

                                            for ($i = 1; $i < 13; $i++){
                                                if (isset($_GET['a']) && isset($_GET['m'])){
                                                    if ($i == $_GET['m']){
                                                        echo ('<a href="news.php?m='.$i.'&a=2019" class="li-hover active list-group-item d-flex justify-content-between align-items-center">
                                                        '.$nomemeses[$i].'
                                                        <span class="badge badge-light badge-pill">');
                                                        echo ($numeromeses[$i]." </span>");
                                                        echo ('</a>');
                                                    }
                                                    else{
                                                        echo ('<a href="news.php?m='.$i.'&a=2019" class="li-hover list-group-item d-flex justify-content-between align-items-center">
                                                        '.$nomemeses[$i].'
                                                        <span class="badge badge-primary badge-pill">');
                                                        echo ($numeromeses[$i]." </span>");
                                                        echo ('</a>');
                                                    }
                                                }
                                                else{
                                                    echo ('<a href="news.php?m='.$i.'&a=2019" class="li-hover list-group-item d-flex justify-content-between align-items-center">
                                                        '.$nomemeses[$i].'
                                                        <span class="badge badge-primary badge-pill">');
                                                        echo ($numeromeses[$i]." </span>");
                                                    echo ('</a>');
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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