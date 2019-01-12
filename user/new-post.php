<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>BlogDeNoticias | Postar</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css" />
        <link rel="stylesheet" href="../css/style-sidebar-dropdown.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/png" href="images/Favicon.png"/>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>
<body>
    <div class="container-fluid p-0">
        <header>
            <figure class="figure-header">
                <a href="index.php">
                    LOGO DO BLOG
                </a>
            </figure>
            <h2 class="title-header">BLOG DE NOTÍCIAS</h2>
            <nav class="navbar navbar-expand-sm bg-gray navbar-light justify-content-center">
                <ul class="navbar-nav" style="margin-right: 61%;">
                    <li class="nav-item border-right border-secondary pr-2" style="line-height: 250%;">Olá, $marinelson. </li>
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
                <!--<ul class="navbar-nav" style="margin-right: 49%;">
                    <li class="nav-item active">
                    <a class="nav-link" href="#">Início</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Noticias
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Colunas</a>
                            <a class="dropdown-item" href="#">Matérias</a>
                            <a class="dropdown-item" href="#">Reportagens</a>
                        </div>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="sobre.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="contato.php">Contato</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="logar.php">Logout</a>
                    </li>
                </ul>
                    <form class="form-inline pull-right" style="margin-right: ;" action="/action_page.php">
                        <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar notícias" required>
                        <button class="btn btn-primary font-weight-bold" type="submit">Pesquisar <i class="fa fa-search fa-md"></i></button>
                    </form>-->
            </nav>
        </header>
            <div class="col-md-11 float-left mt-2 ml-5">
                <h3>Nova postagem <i class="fa fa-newspaper fa-md"></i></h3>
                <form class="form-postar col-md-6" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titulo">Título: </label>
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Insira o título da postagem" required>
                        <label for="resumo">Resumo: </label>
                        <textarea rows="3" class="form-control" id="resumo" name="resumo" placeholder="Insira um breve resumo sobre a postagem" required></textarea>
                        <label for="tema">Tema: </label>
                        <select class="form-control" required>
                            <option value="">Selecione</option>
                            <option value="ESPORTE">Esporte</option>
                            <option value="LAZER">Lazer</option>
                            <option value="POLITICA">Política</option>
                            <option value="SAUDE">Saúde</option>
                            <option value="MUNDO">Mundo</option>

                        </select>
                        <label for="imagem">Imagem: </label>
                        <input type="file" class="form-control-file" id="imagem" name="imagem" required>
                        <label for="arquivo">Arquivo em .PDF: </label>
                        <input type="file" class="form-control-file" id="arquivo" name="arquivo" required>
                        <label for="linkyoutube">Link do vídeo: </label>
                        <input type="text" class="form-control mb-3" id="linkyoutube" name="linkyoutube" placeholder="Insira o link do vídeo no YouTube sobre a postagem" required>
                        <input type="submit" class="btn btn-success pull-right font-weight-bold mb-5" value="Postar">
                        <input type="reset" class="btn btn-warning pull-left font-weight-bold" value="Limpar">
                    </div>
                </form>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br>            <br><br><br><br><br><br><br><br><br><br><br>
        <footer>
            <div class="row">
                <div class="col-sm-4 col-footer">Blog de Notícias</div>
                <div class="col-sm-4 col-footer"><a href="#" target="_blank" title="Página oficial no Facebook" alt="Link externo que redireciona a pagina oficial no Facebook do BlogDeNoticias"><i class="fab fa-facebook fa-lg"></i> Blog de Notícias</a>
                </div>
                <div class="col-sm-4 col-footer"><a href="https://github.com/PabloLuiz1/BlogDeNoticias" target="_blank" title="Repositório Git deste projeto" alt="Link externo que redireciona ao projeto git deste site na plataforma online GitHub">
                    <i class="fas fa-code-branch"></i>Repositório git</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-footer"></div>
                <div class="col-sm-4 col-footer"> <a href="#" target="_blank" title="Canal no YouTube" alt="Link externo que redireciona ao canal do YouTube do BlogDeNoticias">
                    <i class="fab fa-youtube fa-lg"></i>/blogdenoticias</a>
                </div>
                <div class="col-sm-4 col-footer">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-footer"></div>
                <div class="col-sm-4 col-footer"><a href="mailto:contato@blogdenoticias.com" target="_blank" title="E-mail para contato" alt="Link externo que aciona a ação de enviar e-mail">
                    <i class="fa fa-envelope fa-lg"></i>contato@blogdenoticias.com</a></div>
                <div class="col-sm-4 col-footer">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-footer"></div>
                <div class="col-sm-4 col-footer"><a href="callto:+5511912345678" target="_blank" title="WhatsApp para contato" alt="Link externo que aciona a ação de adicionar contato">
                    <i class="fab fa-whatsapp-square fa-lg"></i>+55 11 91234-5678</a></div>
                <div class="col-sm-4 col-footer">Newsletter - Saiba de cada postagem nova no blog:
                    <form class="form-inline newsletter" action="#">
                    <input class="form-control col-sm-8 mr-sm-4" type="text" placeholder="E-mail" required>
                    <button class="btn btn-success font-weight-bold" type="submit">Assinar</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"><span class="copyright">Desenvolvido por Pablo Luiz - BlogDeNoticias todos os direitos reservados, 2019.
                    <i class="fa fa-copyright fa-lg"></i></span></div>
                <div class="col-sm-4"></div>
            </div>
        </footer>
    </div>
</body>