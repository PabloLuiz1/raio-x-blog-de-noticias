<?php
    require '../php/gerenciaBd.php';
    require '../php/conexao.php';

    function validarNome($nome){
        if (strlen($nome) < 3){
            return "Insira um nome válido.";
        }
        return "";
    }

    function validarEmail($email){
        if (strlen($email) < 8){
            return "Insira um e-mail válido.";
        }
        return "";
    }

    function validarWhatsapp($whatsapp){
        if (strlen($whatsapp) < 11){
            return "Insira o número com o(s) código(s) de área.";
        }
        return "";
    }

    function validarLogin($login){
        if (strlen($login) < 4){
            return "O login precisa ter mais de 3 caracteres.";
        }
        return "";
    }

    function validarSenha($senha){
        if (strlen($senha) < 5){
            return "A senha precisa ter no mínimo 6 caracteres.";
        }
        return "";
    }

    function validarUsuario($usuario){
        $retorno = validarNome($usuario['nome']);
        if (strlen(validarNome($usuario['nome'])) > 0){
            $retorno .= '<br>';
        }
        $retorno .= validarEmail($usuario['email']);
        if (strlen(validarEmail($usuario['email'])) > 0){
            $retorno .= '<br>';
        }
        $retorno .= validarWhatsapp($usuario['whatsapp']);
        if (strlen(validarWhatsapp($usuario['whatsapp'])) > 0){
            $retorno .= '<br>';
        }
        $retorno .= validarLogin($usuario['login']);
        if (strlen(validarLogin($usuario['login'])) > 0){
            $retorno .= '<br>';
        }
        return $retorno;
    }

    function cadastrar($usuario){
        if (strlen(validarUsuario($usuario)) == 0){
            $inseriu = insert('usuario', $usuario);
            if ($inseriu){
                return "";
            }
        }
            return validarUsuario($usuario);
    }

    function editar($usuario){
        if (strlen(validarUsuario($usuario)) == 0){
            $editou = update('usuario', $usuario, 'id = ' . $usuario['id']);
            if ($editou){
                return "";
            }
        }
        return validarUsuario($usuario);
    }

    function editarSenha($usuario){
        return update('usuario', $usuario, 'id = ' . $usuario['id']);
    }

    function consultar(){
        if(select('usuario', 'ativo = 1 AND id <> ' . $_SESSION['id']) == null){
            return false;
        }
        return select('usuario', 'ativo = 1 AND id <> ' . $_SESSION['id']);
    }

    function consultarEu(){
        if(select('usuario', 'ativo = 1 AND id = ' . $_SESSION['id']) == null){
            return false;
        }
        return select('usuario', 'ativo = 1 AND id = ' . $_SESSION['id']);
    }

    function consultarQtdPostagens($usuario){
        if (selectQtdNoticia($usuario) == null){
            return false;
        }
        return selectQtdNoticia($usuario);
    }

    function consultarPorId($usuario){
        return select('usuario', 'ativo = 1 AND id = ' . $usuario['id']);
    }

    function excluir($usuario){
        $excluiu = update('usuario', $usuario, 'id = ' . $usuario['id']);
        if ($excluiu){
            return "Usuário excluído com sucesso.";
        }
        return false;
    }
?>