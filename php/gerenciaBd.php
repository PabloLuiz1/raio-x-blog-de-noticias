<?php

    function execute($query){
        $link = abrirConexao();
        $result = @mysqli_query($link, $query) or die (mysqli_error($link));
        fecharConexao($link);
        return $result;
    }
    
    function insert($tabela, array $dados){
        $table = DB_PREFIX.$tabela;
        $dados = escape($dados);
        $campos = implode(', ', array_keys($dados));
        $valores = "'".implode("', '", $dados)."'";
        $query = "INSERT INTO {$table} ({$campos}) VALUES ({$valores})";
        
        return execute($query);
    }

    /* SELECT DATE_FORMAT(data_publicacao, "%d/%c/%Y - %H:%i") FROM tbnoticia */
    
    function select($tabela, $where = null, $campos = '*'){
        $tabela = DB_PREFIX.$tabela;
        $where = ($where) ? " WHERE {$where}" : null;
        if ($tabela == 'tbcomentarios')
            $query = "SELECT DATE_FORMAT(data_publicacao, '%d/%c/%Y - %H:%i') as dat, id, noticia, comentario, nome, ativo FROM {$tabela}{$where}";
        else
            $query = "SELECT {$campos} FROM {$tabela}{$where}";
        $result = execute($query);
        if(!mysqli_num_rows($result)){
            return false;
        }
        else{
            while($res = mysqli_fetch_assoc($result)){
                $dados[] = $res;
            }
            return $dados;
        }
    }

    function update($tabela, array $dados, $where = null){
        foreach ($dados as $key => $value){
            $campos[] = "{$key} = '{$value}'";
        }
        $campos = implode(', ', $campos);
        $tabela = DB_PREFIX.$tabela;
        $where = ($where) ? " WHERE {$where}" : null;
        $query = "UPDATE {$tabela} SET {$campos}{$where}";
        return execute($query);
    }

    function delete($tabela, $where = null){
        $tabela = DB_PREFIX.$tabela;
        $where = ($where) ? " WHERE {$where}" : null;
        $query = "DELETE FROM {$table}{$where}";
        return execute($query);
    }

    function selectNoticia($where = null){
        $where = ($where) ? " WHERE {$where}" : null;
        $query = "SELECT tbusuario.id as idusuario, tbusuario.nome as nomeusuario, tbnoticia.id as idnoticia, DATE_FORMAT(data_publicacao, '%d/%c/%Y - %H:%i') as dat, titulo, resumo, estado, unidade, 
        imagem, arquivo, video, autor, tbnoticia.ativo FROM tbnoticia INNER JOIN tbusuario ON tbnoticia.autor = tbusuario.id {$where} ORDER BY dat DESC";
        $result = execute($query);
        if(!mysqli_num_rows($result)){
            return false;
        }
        else{
            while($res = mysqli_fetch_assoc($result)){
                $dados[] = $res;
            }
            return $dados;
        }
    }

    function selectQtdNoticia($usuario){
        $query = "SELECT COUNT(autor) as total FROM tbnoticia WHERE ativo = 1 AND autor = ".$usuario['id'];
        $result = execute($query);
        if(!mysqli_num_rows($result)){
            return false;
        }
        else{
            $res = mysqli_fetch_assoc($result);
            return $res;
        }
    }

    function selectNoticiaSeis($where = null){
        $where = ($where) ? " WHERE {$where}" : null;
        $query = "SELECT tbusuario.id as idusuario, tbusuario.nome as nomeusuario, tbnoticia.id as idnoticia, DATE_FORMAT(data_publicacao, '%d/%c/%Y - %H:%i') as dat, titulo, resumo, estado, 
        imagem, arquivo, video, autor, tbnoticia.ativo FROM tbnoticia INNER JOIN tbusuario ON tbnoticia.autor = tbusuario.id {$where} ORDER BY dat DESC LIMIT 6";
        $result = execute($query);
        if(!mysqli_num_rows($result)){
            return false;
        }
        else{
            while($res = mysqli_fetch_assoc($result)){
                $dados[] = $res;
            }
            return $dados;
        }
    }

    function selectQtdPorMes($ano, $mes, $estado = null){
        $estado = ($estado) ? " AND {$estado}" : null;
        $query = "SELECT COUNT(id) as total FROM tbnoticia WHERE ativo = 1 {$estado} AND data_publicacao BETWEEN '{$ano}-{$mes}-01' AND '{$ano}-{$mes}-31'";
        $result = execute($query);
        if(!mysqli_num_rows($result)){
            return false;
        }
        else{
            $res = mysqli_fetch_assoc($result);
            return $res;
        }
    }

    function selectNoticiasPorMes($ano, $mes, $estado = null){
        $estado = ($estado) ? " AND {$estado}" : null;
        $query = "SELECT tbusuario.id as idusuario, tbusuario.nome as nomeusuario, tbnoticia.id as idnoticia, DATE_FORMAT(data_publicacao, '%d/%c/%Y - %H:%i') as dat, titulo, resumo, estado, 
        imagem, arquivo, video, autor, tbnoticia.ativo FROM tbnoticia INNER JOIN tbusuario ON tbnoticia.autor = tbusuario.id WHERE tbnoticia.ativo = 1 {$estado} AND data_publicacao BETWEEN '{$ano}-{$mes}-01' AND '{$ano}-{$mes}-31' ORDER BY dat DESC";
        $result = execute($query);
        if(!mysqli_num_rows($result)){
            return false;
        }
        else{
            while($res = mysqli_fetch_assoc($result)){
                $dados[] = $res;
            }
            return $dados;
        }
        $result = execute($query);
        if(!mysqli_num_rows($result)){
            return false;
        }
        else{
            $res = mysqli_fetch_assoc($result);
            return $res;
        }
    }

    function selectUltimaNoticia(){
        $query = "SELECT MAX(id) as ultima FROM tbnoticia WHERE ativo = 1";
        $result = execute($query);
        if (!mysqli_num_rows($result)){
            return false;
        }
        else{
            $res = mysqli_fetch_assoc($result);
            return $res;
        }
    }

    function checarKey($login, $key){
        $query = "SELECT * FROM tbusuario WHERE login = '$login'";
        $result = execute($query);
        if (!mysqli_num_rows($result)){
            return false;
        }
        else{
            $res = mysqli_fetch_assoc($result);
            $keyCorreta = md5($res['id'].$res['senha']);
            if ($key == $keyCorreta){
                return $res['id'];
            }
        }
    }

    function selectQtdPorEstado($estado){
        $query = "SELECT COUNT(id) as total FROM tbnoticia WHERE ativo = 1 AND estado = '$estado'";
        $result = execute($query);
        if(!mysqli_num_rows($result)){
            return false;
        }
        else{
            $res = mysqli_fetch_assoc($result);
            return $res;
        }
    }

    function selectNoticiasPorEstado($estado){
        $query = "SELECT tbusuario.id as idusuario, tbusuario.nome as nomeusuario, tbnoticia.id as idnoticia, DATE_FORMAT(data_publicacao, '%d/%c/%Y - %H:%i') as dat, titulo, resumo, estado, 
        imagem, arquivo, video, autor, tbnoticia.ativo FROM tbnoticia INNER JOIN tbusuario ON tbnoticia.autor = tbusuario.id WHERE tbnoticia.ativo = 1 AND tbnoticia.estado = '$estado' ORDER BY dat DESC";
        $result = execute($query);
        if(!mysqli_num_rows($result)){
            return false;
        }
        else{
            while($res = mysqli_fetch_assoc($result)){
                $dados[] = $res;
            }
            return $dados;
        }
        $result = execute($query);
        if(!mysqli_num_rows($result)){
            return false;
        }
        else{
            $res = mysqli_fetch_assoc($result);
            return $res;
        }
    }
?>
