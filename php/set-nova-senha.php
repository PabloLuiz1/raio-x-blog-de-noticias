<?php 
    require 'gerenciaBd.php';
    require 'conexao.php';
    
    $usuario = array ('id' => 0, 'senha' => md5($_POST['confirmarsenha']));
    $conexao = abrirConexao();
    $resultado = checarKey($_POST['login'], $_POST['key']);
    if ($resultado){
        $usuario['id'] = $resultado;
        update('usuario',$usuario, 'id = '.$resultado.' AND ativo = 1');
        echo ("<script>alert ('Senha trocada com sucesso.'); location = '../index.php'; </script>");
    }
    else{
        echo ("<script> alert ('Não há nenhum usuário com este login. Tente novamente.'); location = '../index.php';</script>");
    }
?>