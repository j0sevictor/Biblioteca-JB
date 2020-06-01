<?php
    $id = $_GET['id'];

    include_once('Conexao.php');

    $sql = "UPDATE emprestimo
            SET estado = 'Entregue', datadev = NOW()
            WHERE id = $id
            LIMIT 1";
    
    mysqli_query($con, $sql);

    header("Location: devolucoes.php");
?>