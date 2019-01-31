<?php

    function upload($arquivo, $tipo){
        if (isset($arquivo)){
            $estensao = explode('.',$_FILES[$tipo]['name']);
            $estensao = strtolower(end($estensao));
            $novo_nome = md5(time()) . '.' . $estensao;
            $diretorio = "../uploaded/";
        
            move_uploaded_file($_FILES[$tipo]['tmp_name'], $diretorio.$novo_nome);
        
            return $novo_nome;
        }
    }
?>