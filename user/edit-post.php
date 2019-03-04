<!DOCTYPE HTML>
<?php 
    require '../php/validarSessao.php';
    require '../controller/ControllerPost.php';
    require '../php/upload.php';

    $id = array(
        'id' => $_GET['p']
    );

    $editou = "a";
    $conexao = abrirConexao();
    $eu = consultarEu();
    foreach ($eu as $u){
        $meunome = $u['nome'];
    }
    $post = consultarPorId($id);
    foreach($post as $p){
        $titulo = $p['titulo'];
        $resumo = $p['resumo'];
        $estado = $p['estado'];
        $imagem = $p['imagem'];
        $arquivo = $p['arquivo'];
        $video = $p['video'];
    }

    if (isset($_POST ['salvar'])){
        if (strlen($_POST['video']) > 40){
            $codigodovideo = substr($_POST['video'], 32);
            $video = 'https://www.youtube.com/embed/'.$codigodovideo;
        }
        
        if (strlen($_POST['video']) < 40){
            $codigodovideo = substr($_POST['video'], 17);
            $video = 'https://www.youtube.com/embed/'.$codigodovideo;
        }
        $post = array(
            'id' => $id['id'],
            'autor' => $_SESSION['id'],
            'titulo' => $_POST['titulo'],
            'resumo' => $_POST['resumo'],
            'estado' => $_POST['estado'],
            'imagem' => upload($_FILES ['imagem'], 'imagem'),
            'arquivo' => upload($_FILES ['arquivo'], 'arquivo'),
            'video' => $video
        );
        $editou = editar($post);
    }
    fecharConexao($conexao);
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Raio-X | Editar post</title>
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
                    <form class="form-inline pull-right" action="/action_page.php">
                        <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar notícias" required>
                        <button class="btn btn-primary font-weight-bold" type="submit">Pesquisar <i class="fa fa-search fa-sm"></i></button>
                    </form>
            </nav>
        </header>
            <div class="col-md-11 float-left mt-2 ml-5">
                <h3 class="col-md-12">Editar postagem <i class="fa fa-newspaper fa-md"></i></h3>
                <form class="form-postar col-md-6" action="edit-post.php?p=<?php echo $_GET['p'];?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titulo">Título: </label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Insira o título da postagem" value="<?php echo $titulo ?>" required>
                        <label for="resumo">Resumo: </label>
                        <textarea rows="3" class="form-control" id="resumo" name="resumo" placeholder="Insira um breve resumo sobre a postagem" required><?php echo $resumo ?></textarea>
                        <label for="estado">estado: </label>
                        <select name="estado" id="estado" class="form-control" required>
                            "">Selecione</option>
                            "Arquivos do X" <?php if ($estado == "Arquivos do X") echo "selected" ?>>Arquivos do X</option>
                            "Lazer" <?php if ($estado == "Lazer") echo "selected" ?>>Lazer</option>
                            "Política" <?php if ($estado == "Política") echo "selected" ?>>Política</option>
                            "Saúde" <?php if ($estado == "Saúde") echo "selected" ?>>Saúde</option>
                            "Mundo" <?php if ($estado == "Mundo") echo "selected" ?>>Mundo</option>

                        </select>
                        <label for="imagem">Imagem: </label>
                        <ul class="nav nav-pills nav-justified">
                        <li class="nav-item mr-3">
                            <img class="img-fluid rounded" src="../uploaded/<?php echo $imagem ?>">
                        </li>
                        </ul>
                        <input type="file" class="form-control-file" id="imagem" name="imagem" required>
                        <label for="arquivo">Arquivo em .PDF: </label><br>
                        <a href="../uploaded/<?php echo $arquivo ?>" target="_blank"><u><?php echo $arquivo ?></u></a>
                        <input type="file" class="form-control-file" id="arquivo" name="arquivo" required>
                        <label for="video">Link do vídeo: </label>
                        <input type="text" class="form-control mb-3" id="video" name="video" placeholder="Insira o link do vídeo no YouTube sobre a postagem" value="<?php echo $video ?>" required>
                        <div id="erro" class="d-none mx-auto col-sm-12 alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $editou; ?>
                        </div>
                        <div id="sucesso" class="d-none mx-auto col-sm-12 alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Postagem <strong>editada</strong> com sucesso.
                        </div>
                        <input type="submit" name="salvar" class="btn btn-success pull-right font-weight-bold mb-5" value="Salvar">
                        <a href="index.php" class="btn btn-primary pull-left font-weight-bold"><i class="fas fa-arrow-left"></i> Voltar</a>
                    </div>
                </form>
            </div>
            <?php 
                if (strlen($editou) > 0 && isset($_POST['salvar'])){
                    echo ("<script> 
                    $('erro').classList.remove('d-none');
                    $('erro').classList.add('d-block');
                    </script>");
                }
                if (strlen($editou) == 0 && isset($_POST['salvar'])){
                    echo ("<script> 
                    alert ('Postagem editada com sucesso.'); location = location;
                    </script>");
                }
            ?>
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