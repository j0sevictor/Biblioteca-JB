<?php
    $form = $_POST['formulario'];

    include_once('Conexao.php');

    if ($form == 'LIVRO'){

        $id = $_POST["id"];

        $gel = $_POST["genero"];
        $isbn = $_POST["isbn"];
        $titulo = $_POST["titulo"];
        $cdd = $_POST["cdd"];
        $autor = $_POST["nomeautor"];
        $data = $_POST["dataR"];
        $exemp = $_POST["exemp"];

        $capa = $_FILES["capa"]["name"];
        $ccapa = $_FILES["contracapa"]["name"];
        
        $targetc = "_imagens/" . $capa;
        $targetcc = "_imagens/" . $ccapa;
        
        if (!empty($data)) {
            $data = "'" . $data . "'";
        }else{
            $data = 'default';
        }

        if (empty($capa) && empty($ccapa)){
            $sql = "UPDATE livro 
                    SET genero = '$gel', isbn = '$isbn', titulo = '$titulo', cdd = '$cdd', autor = $autor, dataRemessa = $data, exemplares = $exemp
                    WHERE id = $id
                    LIMIT 1";
        }else if(!empty($capa) && empty($ccapa)){
            $sql = "UPDATE livro 
                    SET genero = '$gel', isbn = '$isbn', titulo = '$titulo', cdd = '$cdd', autor = $autor, dataRemessa = $data, exemplares = $exemp, capa = '$capa'
                    WHERE id = $id
                    LIMIT 1";
            move_uploaded_file($_FILES["capa"]["tmp_name"], $targetc);
        }else if(!empty($ccapa) && empty($capa)){
            $sql = "UPDATE livro 
                    SET genero = '$gel', isbn = '$isbn', titulo = '$titulo', cdd = '$cdd', autor = $autor, dataRemessa = $data, exemplares = $exemp, contra = '$ccapa'
                    WHERE id = $id
                    LIMIT 1";
            move_uploaded_file($_FILES["contracapa"]["tmp_name"], $targetcc);
        }else{
            $sql = "UPDATE livro 
                    SET genero = '$gel', isbn = '$isbn', titulo = '$titulo', cdd = '$cdd', autor = $autor, dataRemessa = $data, exemplares = $exemp, capa = '$capa', contra = '$ccapa'
                    WHERE id = $id
                    LIMIT 1";
            move_uploaded_file($_FILES["capa"]["tmp_name"], $targetc);
            move_uploaded_file($_FILES["contracapa"]["tmp_name"], $targetcc);
        }
        
        mysqli_query($con, $sql);


       header('Location: listarLivros.php');
    }else if ($form == 'AUTOR'){

        $id = $_POST["id"];

        $nome = $_POST["nomeautor"];
        $desc = $_POST["desc"];
        $data = $_POST["datanasc"];
        $autmes = $_POST["autordomes"];

        $foto = $_FILES["fotoAutor"]["name"];
        
        if (empty($autmes)){
            $autmes = 'false';
        }

        if (!empty($data)) {
            $data = "'" . $data . "'";
        }else{
            $data = 'default';
        }

        if (!empty($foto)) {
            $sql = "UPDATE autor
                    SET nome = '$nome', descricao = '$desc', dataNasc = $data, autordomes = $autmes, foto = '$foto'
                    WHERE id = $id
                    LIMIT 1";
            $target = "_imagens/" . $foto;
            move_uploaded_file($_FILES["fotoAutor"]["tmp_name"], $target);
        }else{
            $sql = "UPDATE autor
                    SET nome = '$nome', descricao = '$desc', dataNasc = $data, autordomes = $autmes
                    WHERE id = $id
                    LIMIT 1";
        }

        mysqli_query($con, $sql);

        header('Location: listarAutores.php');
        
    }

?>