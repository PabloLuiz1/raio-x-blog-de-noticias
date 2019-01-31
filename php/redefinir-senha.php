<?php
    require 'gerenciaBd.php';
    require 'conexao.php';

    $email = $_POST['email'];
    $conexao = abrirConexao();
    $usuarios = select('usuario', "ativo = 1 AND email = '".$email."'");
    if ($usuarios){
        foreach ($usuarios as $u){
            $key = md5($u['id'].$u['senha']);
            $to = $u['email']; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
            $email_subject = "Tribuna Direta: Redefinição de senha";
            $email_body = '<font color="black">Olá '.$u['nome'].'. Aqui está o link para a redefinição da sua senha: </font><br> <a href="http://blogdenoticias/change-password.php?k='.$key.'">Clique aqui</a>
            <br><font color="black">Caso não esteja conseguindo clicar no link, copie e cole-o no navegador: http://growupweb.com.br/blogdenoticias/change-password.php?k='.$key.'<br></font>';
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= "From: Suporte - Tribuna Direta <suporte@tribunadireta.com>\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
            $headers .= "Content-Type: text/html\n";
            mail($to,$email_subject,$email_body,$headers);
            echo ("<script> alert ('Enviamos um link para redefinição da senha neste e-mail.'); history.back(-2);</script>");
        }
    }
    else{
        echo ('<script> alert ("Não há nenhum usuário cadastrado com este e-mail."); history.back(-2);</script>');
    }
    fecharConexao($conexao);
?>