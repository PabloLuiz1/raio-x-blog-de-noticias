<?php
    require '../php/gerenciaBd.php';
    require '../php/conexao.php';

    function validarTitulo($titulo){
        if (strlen($titulo) < 6){
            return "Insira um título válido.";
        }
        return "";
    }

    function validarResumo($resumo){
        if (strlen($resumo) < 10){
            return "Insira um resumo válido.";
        }
        return "";
    }

    function validarEstado($estado){
        if (strlen($estado) != 2){
            return "Selecione um estado.";
        }
        return "";
    }

    function validarUnidade($unidade){
        if (strlen($unidade) < 2){
            return "Insira uma unidade válida. ";
        }
        return "";
    }

    function validarYouTube($link){
        if (strlen($link) < 21){
            return "Insira um link do YouTube válido.";
        }
        return "";
    }

    function validarPost($post){
        $retorno = validarTitulo($post['titulo']);
        if (strlen(validarTitulo($post['titulo'])) > 0){
            $retorno .= '<br>';
        }
        $retorno .= validarResumo($post['resumo']);
        if (strlen(validarResumo($post['resumo'])) > 0){
            $retorno .= '<br>';
        }
        $retorno .= validarEstado($post['estado']);
        if (strlen(validarEstado($post['estado'])) > 0){
            $retorno .= '<br>';
        }
        $retorno .= validarUnidade($post['unidade']);
        if (strlen(validarUnidade($post['unidade'])) > 0){
            $retorno .= '<br>';
        }
        $retorno .= validarYouTube($post['video']);
        if (strlen(validarYouTube($post['video'])) > 0){
            $retorno .= '<br>';
        }
        return $retorno;
    }

    function cadastrar($post){
        if (strlen(validarPost($post)) == 0){
            $inseriu = insert('noticia', $post);
            if ($inseriu){
                
                return "";
            }
        }
            return validarPost($post);
    }

    function editar($post){
        if (strlen(validarPost($post)) == 0){
            $editou = update('noticia', $post, 'id = ' . $post['id']);
            if ($editou){
                return "";
            }
        }
        return validarPost($post);
    }

    function consultar(){
        if(selectNoticia('tbnoticia.ativo = 1') == null){
            return false;
        }
        return selectNoticia('tbnoticia.ativo = 1');
    }

    function consultarMinhas($id){
        if(selectNoticia('tbnoticia.ativo = 1 AND autor = ' .$id) == null){
            return false;
        }
        return selectNoticia('tbnoticia.ativo = 1 AND autor = ' .$id);
    }

    function consultarSeis(){
        if(selectNoticiaSeis('tbnoticia.ativo = 1') == null){
            return false;
        }
        return selectNoticia('tbnoticia.ativo = 1');
    }

    function consultarPorId($post){
        return selectNoticia('tbnoticia.ativo = 1 AND tbnoticia.id = ' . $post['id']);
    }

    function consultarEu(){
        if(select('usuario', 'ativo = 1 AND id = ' . $_SESSION['id']) == null){
            return false;
        }
        return select('usuario', 'ativo = 1 AND id = ' . $_SESSION['id']);
    }

    function excluir($post){
        $excluiu = update('noticia', $post, 'id = ' . $post['id']);
        if ($excluiu){
            return "Postagem excluída com sucesso.";
        }
        return false;
    }

    function notificarNovoPost($post){
        $assunto = "Raio-X - Confira a nova postagem no nosso blog";
        $mensagem = "<h4>Esta é uma mensagem automática, não a responda.</h4>";
        $mensagem .= "<br>Olá! Confira a nova postagem feita no nosso blog: <br>";
        $mensagem .= "<h4>".$post['titulo']."</h4>";
        $mensagem .= "<br>".$post['resumo'];
        $mensagem .= '<a href="http://growupweb.com.br/Raio-X/news.php?n='.$post['id'].'>Clique aqui para acessar a notícia</a>';
        $mensagem .= "<br> Caso não esteja conseguindo clicar no link, copie e cole o seguinte endereço no seu navegador:";
        $mensagem .= "http://growupweb.com.br/Raio-X/news.php?=".$post['id'];
        $assinantes = select('assinante','ativo = 1');
        
        foreach ($assinantes as $a){
            $email = $a['email'];

            $header = "MIME-Version: 1.0\r\n";
            $header .= "Content-type: image/png\r\n";
            $header .= "Content-type: text/html\r\n";
            $header .= "From: newsletter@tribunadireta.com\r\n";

            mail($email, $assunto, $mensagem, $header);
        }
    }
?>