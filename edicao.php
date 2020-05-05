<?php
    $form = $_POST['formulario'];

    if ($form == 'livro'){

        $id = $_POST["id"];

        $gel = $_POST["genero"];
        $isbn = $_POST["isbn"];
        $titulo = $_POST["titulo"];
        $cdd = $_POST["cdd"];
        $autor = $_POST["nomeautor"];
        $data = $_POST["dataR"];
        $exemp = $_POST["exemp"];

        include_once('Conexao.php');
        
        $sql = "UPDATE livro 
                SET genero = '$gel', isbn = '$isbn', titulo = '$titulo', cdd = '$cdd', autor = $autor, dataRemessa = '$data', exemplares = $exemp
                WHERE id = $id
                LIMIT 1";
        
        $r = mysqli_query($con, $sql);

        header('Location: listarLivros.php');

        
    }

?>