<?php
    include_once('autenticador.php');
    include_once('Conexao.php');

    $tipo = $_GET['tipo'];
    $id = $_GET['id'];

    if ($tipo == 'LIVRO'){

        $sql = "DELETE FROM livro WHERE id = $id LIMIT 1";

        mysqli_query($con, $sql);

        header('Location: listarLivros.php');
    }elseif ($tipo == 'AUTOR'){

        $sql = "DELETE FROM autor WHERE id = $id LIMIT 1";

        mysqli_query($con, $sql);

        header('Location: listarAutores.php');

    }elseif ($tipo == 'ALUNO'){

        $sql = "DELETE FROM aluno WHERE id = $id LIMIT 1";

        if (mysqli_query($con, $sql)){
            $sql = "DELETE FROM emprestimo WHERE leitorid = $id AND permicao = '$tipo'";
            mysqli_query($con, $sql);
        }

        header('Location: pendencias.php');

    }elseif ($tipo == 'PROFESSOR'){
        
        $sql = "DELETE FROM professor WHERE id = $id LIMIT 1";

        if (mysqli_query($con, $sql)){
            $sql = "DELETE FROM emprestimo WHERE leitorid = $id AND permicao = '$tipo'";
            mysqli_query($con, $sql);
        }

        header('Location: pendencias.php');

    }elseif ($tipo == 'EMPRESTIMO'){

        $sql = "DELETE FROM emprestimo WHERE id = $id LIMIT 1";
        mysqli_query($con, $sql);

        header('Location: pendencias.php');

    }elseif ($tipo == 'IMAGEM') {
        
        $target = $_GET['target'];
        $lado = $_GET['lado'];

        if ($target) {
            $sql = "UPDATE livro
                    SET $lado = ''
                    WHERE id = $id
                    LIMIT 1";
            mysqli_query($con, $sql);

            unlink($target);
        }

        header("Location: editarLivro.php?id=$id");

    }elseif ($tipo == 'FOTO'){
        $target = $_GET['target'];

        if ($target) {
            $sql = "UPDATE autor
                    SET foto = ''
                    WHERE id = $id
                    LIMIT 1";
            mysqli_query($con, $sql);

            unlink($target);
        }

        header("Location: editarAutor.php?id=$id");
    }
    
?>