<?php
    include_once('autenticador.php');
    include_once('Conexao.php');

    $tipo = $_GET['tipo'];

    if ($tipo == 'LIVRO'){

        $id = $_GET['id'];

        $sql = "DELETE FROM livro WHERE id = $id LIMIT 1";

        mysqli_query($con, $sql);

        header('Location: listarLivros.php');
    }else if ($tipo == 'AUTOR'){

        $id = $_GET['id'];

        $sql = "DELETE FROM autor WHERE id = $id LIMIT 1";

        mysqli_query($con, $sql);

        header('Location: listarAutores.php');
    }
    
?>