<!DOCTYPE HTML>
<?php 
    require '../php/validarSessao.php';
    require '../controller/ControllerPost.php';
    require '../php/upload.php';

    $cadastrou = 0;
    $post;
    $conexao = abrirConexao();
    $eu = consultarEu();
    foreach ($eu as $u){
        $meunome = $u['nome'];
    }
    if (isset($_POST['postar'])){
        if (strlen($_POST['video']) > 40){
            $codigodovideo = substr($_POST['video'], 32);
            $video = 'https://www.youtube.com/embed/'.$codigodovideo;
        }
        
        if (strlen($_POST['video']) < 40){
            $codigodovideo = substr($_POST['video'], 17);
            $video = 'https://www.youtube.com/embed/'.$codigodovideo;
        }

        $post = array(
            'data_publicacao' => date('Y-m-d H:i:s'),
            'autor' => $_SESSION['id'],
            'titulo' => $_POST['titulo'],
            'resumo' => $_POST['resumo'],
            'estado' => $_POST['estado'],
            'unidade' => $_POST['unidade'],
            'imagem' => upload($_FILES ['imagem'], 'imagem'),
            'arquivo' => upload($_FILES ['arquivo'], 'arquivo'),
            'video' => $video
        );
        $cadastrou = cadastrar($post);
    }
    fecharConexao($conexao);
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Raio-X | Postar</title>
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
                        <a class="nav-link" href="#">Postar</a>
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
                <h3 class="col-md-12">Nova postagem <i class="fa fa-newspaper fa-md"></i></h3>
                <form class="form-postar col-md-6" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titulo">Título: </label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Insira o título da postagem" required>
                        <label for="resumo">Resumo: </label>
                        <textarea rows="3" class="form-control" id="resumo" name="resumo" placeholder="Insira um breve resumo sobre a postagem" required></textarea>
                        <label for="estado">Estado: </label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="">Selecione</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                        <label for="unidade">Unidade: </label>
                        <input type="text" class="form-control" id="unidade" name="unidade" placeholder="Insira o nome da unidade" required>
                        <label for="imagem">Imagem: </label>
                        <input type="file" class="form-control-file" id="imagem" name="imagem" required>
                        <label for="arquivo">Arquivo em .PDF: </label>
                        <input type="file" class="form-control-file" id="arquivo" name="arquivo" required>
                        <label for="video">Link do vídeo: </label>
                        <input type="text" class="form-control mb-3" id="video" name="video" placeholder="Insira o link do vídeo no YouTube sobre a postagem" required>
                        <div id="erro" class="d-none mx-auto col-sm-12 alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $cadastrou; ?>
                        </div>
                        <div id="sucesso" class="d-none mx-auto col-sm-12 alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Postagem <strong>cadastrada</strong> cadastrado com sucesso.
                        </div>
                        <input type="submit" name="postar" class="btn btn-success pull-right font-weight-bold mb-5" value="Postar">
                        <input type="reset" class="btn btn-warning pull-left font-weight-bold" value="Limpar">
                    </div>
                </form>
            </div>
            <?php 
                if (strlen($cadastrou) > 0 && isset($_POST['postar'])){
                    echo ("<script> 
                    document.getElementById('erro').classList.remove('d-none');
                    document.getElementById('erro').classList.add('d-block');
                    </script>");
                }
                if (strlen($cadastrou) == 0 && isset($_POST['postar'])){
                    echo ("<script> 
                    alert ('Postagem realizada com sucesso.');
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