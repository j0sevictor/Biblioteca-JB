<?php
    $id = $_GET['id'];
    $tipo = $_GET['tipo'];

    include_once('Conexao.php');

    if ($tipo == 'ALUNO'){
        $sql = "UPDATE emprestimoaluno
                SET estado = 'Entregue'
                WHERE id = $id
                LIMIT 1";
    }else if ($tipo == 'PROF'){
        $sql = "UPDATE emprestimoprof
                SET estado = 'Entregue'
                WHERE id = $id
                LIMIT 1";
    }
    
    mysqli_query($con, $sql);

    header("Location: devolucoes.php");
?>