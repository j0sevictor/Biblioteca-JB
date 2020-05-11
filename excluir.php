<?php
    include_once('autenticador.php');

    $id = $_GET['id'];

    include_once('Conexao.php');

    $sql = "DELETE FROM livro WHERE id = $id LIMIT 1";

    mysqli_query($con, $sql);

    header('Location: listarLivros.php');
?>