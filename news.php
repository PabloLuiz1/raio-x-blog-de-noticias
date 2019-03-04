<!DOCTYPE HTML>
<?php 
    require 'php/conexao.php';
    require 'php/gerenciaBd.php';
    require 'php/data-manager.php';
    require 'php/validarSessao.php';
    
    $conexao = abrirConexao();
    $numeroestados = array (
                        'AC' => selectQtdPorEstado('AC')['total'],
                        'AL' => selectQtdPorEstado('AL')['total'],
                        'AP' => selectQtdPorEstado('AP')['total'],
                        'AM' => selectQtdPorEstado('AM')['total'],
                        'BA' => selectQtdPorEstado('BA')['total'],
                        'CE' => selectQtdPorEstado('CE')['total'],
                        'DF' => selectQtdPorEstado('DF')['total'],
                        'ES' => selectQtdPorEstado('ES')['total'],
                        'GO' => selectQtdPorEstado('GO')['total'],
                        'MA' => selectQtdPorEstado('MA')['total'],
                        'MT' => selectQtdPorEstado('MT')['total'],
                        'MS' => selectQtdPorEstado('MS')['total'],
                        'MG' => selectQtdPorEstado('MG')['total'],
                        'PA' => selectQtdPorEstado('PA')['total'],
                        'PB' => selectQtdPorEstado('PB')['total'],
                        'PR' => selectQtdPorEstado('PR')['total'],
                        'PE' => selectQtdPorEstado('PE')['total'],
                        'PI' => selectQtdPorEstado('PI')['total'],
                        'RJ' => selectQtdPorEstado('RJ')['total'],
                        'RN' => selectQtdPorEstado('RN')['total'],
                        'RS' => selectQtdPorEstado('RS')['total'],
                        'RO' => selectQtdPorEstado('RO')['total'],
                        'RR' => selectQtdPorEstado('RR')['total'],
                        'SC' => selectQtdPorEstado('SC')['total'],
                        'SP' => selectQtdPorEstado('SP')['total'],
                        'SE' => selectQtdPorEstado('SE')['total'],
                        'TO' => selectQtdPorEstado('TO')['total']
                );

    if(isset($_POST['comentar'])){
        $comentario = array(
            'noticia' => $_GET['n'],
            'comentario' => $_POST['comentario'],
            'nome' => $_POST['nome'],
            'data_publicacao' => date('Y-m-d H:i:s')
        );
        if (insert('comentarios',$comentario)){
            echo ("<script> alert ('Comentário publicado com sucesso.'); 
            location = location;
            </script>");
        }
        else{
            echo ("<script> alert ('Erro ao publicar o comentário.'); 
            </script>");
        }
    }

    if (isset($_GET['n'])){
        $noticia = selectNoticia('tbnoticia.ativo = 1 AND tbnoticia.id = '.$_GET['n']);
        $comentarios = select('comentarios','ativo = 1 AND noticia = '.$_GET['n']);
        foreach ($noticia as $n){
            $datapublicacao = $n['dat'];
            $titulo = $n['titulo'];
            $resumo = $n['resumo'];
            $estado = $n['estado'];
            $unidade = $n['unidade'];
            $imagem = $n['imagem'];
            $arquivo = $n['arquivo'];
            $video = $n['video'];
            $autor = $n['nomeusuario'];
        }
    }
    $noticias;
    $mes;
    if (isset($_GET['e'])){
        $noticias = selectNoticiasPorEstado($_GET['e']);
    }

?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Raio-X | Notícias</title>
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
                    <li class="nav-item ">
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
                <div class="col-md-8 float-left mt-2 ml-4 mr-3">
                    <?php if (isset($_GET['n'])){
                        echo ('<h2 class="col-md-12 border-bottom border-secondary">'.$titulo.'</h2>
                        '.$resumo.'<br><strong>Estado: </strong>'.$estado.'<br> <strong>Unidade: </strong>'.$unidade.'
                        <iframe class="frame-noticia mx-auto" src="uploaded/'.$arquivo.'"></iframe>
                        <h4 class="col-md-12 border-bottom border-secondary">Vídeo: <i class="fa fa-video fa-md"></i></h4>
                        <iframe class="frame-video" width="560" height="315" src="'.$video.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <span class="calibri-12"><strong>Publicado por: </strong>'.$autor.'. <br><strong>Data da publicação:</strong> '.$datapublicacao.'
                        </span>');
                        echo ('<div id="comments">
                            <h4 class="mt-2 col-md-12 border-bottom border-secondary">Comentários: <i class="fa fa-comment fa-md"></i></h4>');
                        if (!$comentarios){
                            echo ('<div class="alert alert-light text-center">
                                Seja o primeiro a comentar.
                            </div>
                            <hr>');
                        }
                        else{
                            session_start();
                            foreach ($comentarios as $c){
                                if (isset($_SESSION['admin'])){
                                    $deletar = '<a class="btn btn-danger btn-sm pull-right" href="delete-comment.php?c='.$c['id'].'"><i class="fa fa-trash-alt fa-lg"></i></a>';
                                    echo ('<div class="card">
                                    <div class="card-header"><span style="font-size: 32px;"><i class="fa fa-user-circle fa-lg"></i></span> '.$c['nome'].' <strong>comentou:</strong> </div>
                                    <div class="card-body">'.$c['comentario'].'</div>
                                    <div class="card-footer"><strong>Data:</strong> '.$c['dat'].' '.$deletar.' </div>
                                    </div>
                                    <br>');
                                }
                                else{
                                    $deletar = "";
                                    echo ('<div class="card">
                                    <div class="card-header"><span style="font-size: 32px;"><i class="fa fa-user-circle fa-lg"></i></span> '.$c['nome'].' <strong>comentou:</strong> </div>
                                    <div class="card-body">'.$c['comentario'].'</div>
                                    <div class="card-footer"><strong>Data:</strong> '.$c['dat'].' '.$deletar.' </div>
                                    </div>
                                    <br>');
                                }
                            }
                            echo ('<hr>');
                        }
                            echo ('<h5 class="col-md-12">Faça um comentário: </h5>
                            <form class="form-postar" action="news.php?n='.$_GET['n'].'" method="POST">
                                <div class="form-group col-md-6">
                                    <label for="nome">Nome: </label>
                                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Insira o seu nome" required>
                                    <label for="comentario">Comentário: </label>
                                    <textarea class="form-control mb-3" name="comentario" id="comentario" rows=3 placeholder="Insira o seu comentário" required></textarea>
                                    <input type="submit" name="comentar" class="btn btn-success pull-right font-weight-bold mb-5" value="Comentar">
                            </form>
                        </div>');
                    }
                    if (isset($_GET['e'])){
                        if (isset($_GET['t']))
                            echo ('<h2 class="col-md-12 border-bottom border-secondary">'.$_GET['t'].' - Postagens de '.$mes.'/'.$_GET['a'].'</h2>');
                        else
                            echo ('<h2 class="col-md-12 border-bottom border-secondary">Postagens do estado de '.$_GET['e'].'</h2>');
                        if (!$noticias){
                            echo ('Não há postagens neste estado.');
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
                                        echo ('<strong>Estado: </strong> '.$n['estado'].'<br> <strong>Autor: </strong>'.$n['nomeusuario'].' 
                                        <br> <strong>Publicação: </strong>'.$n['dat'].'
                                        <br> <a class="p-0 nav-link text-center" href="news.php?n='.$n['idnoticia'].'#comments" title="Ver os comentários desta postagem">
                                        <strong>Comentários <i class="fa fa-comment fa-sm"></i></strong></a>');
                                    echo ('</div>');
                                echo ('</div>');
                            }
                            echo ('</ul>');
                        }   
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
                                            $nomeestados = array (
                                                'AC' => "Acre",
                                                'AL' => "Alagoas",
                                                'AP' => "Amapá",
                                                'AM' => "Amazonas",
                                                'BA' => "Bahia",
                                                'CE' => "Ceará",
                                                'DF' => "Distrito Federal",
                                                'ES' => "Espírito Santo",
                                                'GO' => "Goiás",
                                                'MA' => "Maranhão",
                                                'MT' => "Mato Grosso",
                                                'MS' => "Mato Grosso do Sul",
                                                'MG' => "Minas Gerais",
                                                'PA' => "Pará",
                                                'PB' => "Paraíba",
                                                'PR' => "Paraná",
                                                'PE' => "Pernambuco",
                                                'PI' => "Piauí",
                                                'RJ' => "Rio de Janeiro",
                                                'RN' => "Rio Grande do Norte",
                                                'RS' => "Rio Grande do Sul",
                                                'RO' => "Rondônia",
                                                'RR' => "Roraima",
                                                'SC' => "Santa Catarina",
                                                'SP' => "São Paulo",
                                                'SE' => "Sergipe",
                                                'TO' => "Tocantins"
                                            );

                                            foreach ($nomeestados as $key => $value ){
                                                if (isset($_GET['e'])){
                                                    if ($key == $_GET['e']){
                                                        echo ('<a href="news.php?e='.$key.'" class="li-hover active list-group-item d-flex justify-content-between align-items-center">
                                                        '.$nomeestados[$key].'
                                                        <span class="badge badge-light badge-pill">');
                                                        echo ($numeroestados[$key]." </span>");
                                                        echo ('</a>');
                                                    }
                                                    else{
                                                        echo ('<a href="news.php?e='.$key.'" class="li-hover list-group-item d-flex justify-content-between align-items-center">
                                                        '.$nomeestados[$key].'
                                                        <span class="badge badge-primary badge-pill">');
                                                        echo ($numeroestados[$key]." </span>");
                                                        echo ('</a>');
                                                    }
                                                }
                                                else{
                                                    echo ('<a href="news.php?e='.$key.'" class="li-hover list-group-item d-flex justify-content-between align-items-center">
                                                        '.$nomeestados[$key].'
                                                        <span class="badge badge-primary badge-pill">');
                                                        echo ($numeroestados[$key]." </span>");
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
        <footer>
        <div class="row">
                <div class="col-sm-4 col-footer">
                    <a href="index.php">
                        <img src="images/logotipo.jpeg" class="img-responsive"> Raio-X
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
<?php 
    fecharConexao($conexao);
?>