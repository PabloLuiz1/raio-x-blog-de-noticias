<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>BlogDeNoticias | Início</title>
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="shortcut icon" type="image/png" href="images/Favicon.png"/>
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
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
                <ul class="navbar-nav" style="margin-right: 49%;">
                    <li class="nav-item">
                    <a class="nav-link" href="../../index.php">Início</a>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Noticias
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../esporte">Esporte</a>
                            <a class="dropdown-item" href="../lazer">Lazer</a>
                            <a class="dropdown-item" href="../politica">Política</a>
                            <a class="dropdown-item" href="../saude">Saúde</a>
                            <a class="dropdown-item active" href="#">Mundo</a>
                        </div>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../../about.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../../contact.php">Contato</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../../login.php">Logar</a>
                    </li>
                </ul>
                    <form class="form-inline pull-right" style="margin-right: ;" action="/action_page.php">
                    <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar notícias" required>
                    <button class="btn btn-primary font-weight-bold" type="submit">Pesquisar <i class="fa fa-search fa-sm"></i></button>
                </form>
            </nav>
        </header>
                <div class="col-md-8 float-left mt-2 ml-4 mr-3">
                    <h2 class="col-md-12 border-bottom border-secondary">Últimas notícias</h2>
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="#">
                            <img class="img-fluid rounded" src="../images/teste.png">
                            A mentira da rota blablablablabla</a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="#">
                            <img class="img-fluid rounded" src="../images/teste.png">
                            A mentira da rota blablablablabla</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <img class="img-fluid rounded" src="../images/teste.png">
                            A mentira da rota blablablablabla</a>
                        </li>
                    </ul>
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="#">
                            <img class="img-fluid rounded" src="../images/teste.png">
                            A mentira da rota blablablablabla</a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="#">
                            <img class="img-fluid rounded" src="../images/teste.png">
                            A mentira da rota blablablablabla</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <img class="img-fluid rounded" src="../images/teste.png">
                            A mentira da rota blablablablabla</a>
                        </li>
                    </ul>
                    <br><br><br><br><br><br>
                </div>
                <div class="col-md-3 float-left mt-2 p-0 ml-5">
                    <h3>Arquivo</h3>
                    <div id="accordion">
                            <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                2019
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <ul class="list-group">
                                        <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                                            Janeiro
                                            <span class="badge badge-primary badge-pill">0</span>
                                        </a>
                                        <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                                            Fevereiro
                                            <span class="badge badge-primary badge-pill">0</span>
                                        </a>
                                        <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                                            Março
                                            <span class="badge badge-primary badge-pill">0</span>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <button class="btn btn-success" type="submit">Assinar</button>
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