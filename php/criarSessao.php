<?php
    require 'gerenciaBd.php';
    require 'conexao.php';

    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $conexao = abrirConexao();
    $usuario = select('usuario', "login = '$login' AND senha = '$senha'");
    if ($usuario){
        foreach ($usuario as $u){
            $nome = $u['nome'];
            $id = $u['id'];
        }
        $dados = array(
                    'login' => $login,
                    'senha' => $senha,
                    'nome' => $nome_usuario,
                    'id' => $id_usuario
                );
        session_start();
        $_SESSION['login'] = $dados['login'];
        $_SESSION['senha'] = $dados['senha'];
        $_SESSION['nome'] = $dados['nome'];
        $_SESSION['id'] = $dados['id'];
        header ("Location: /user/index.php");
    }
    else{
        echo ('<script> alert("Login ou senha inválidos."); location.href="../login.php";</script>');
    }
    fecharConexao($conexao);
?>