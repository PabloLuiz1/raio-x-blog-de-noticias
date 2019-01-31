<?php
    require 'gerenciaBd.php';
    require 'conexao.php';
    
    $email = $_POST ['email'];
    $assinante = array(
        'email' => $email
    );

    if(insert('assinante', $assinante)){
        echo ("<script> alert ('Cadastrado com sucesso no nosso news-letter.'); </script>");
    }

?>