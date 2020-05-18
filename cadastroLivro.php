<?php
	$gel = $_POST["genero"];
	$isbn = $_POST["isbn"];
	$titulo = $_POST["titulo"];
	$cdd = $_POST["cdd"];
	$autor = $_POST["autor"];
	$data = $_POST["dataR"];
	$exemp = $_POST["exemp"];

	$capa = $_FILES["capa"]["name"];
	$ccapa = $_FILES["contracapa"]["name"];

	include_once("Conexao.php");

	if (!empty($data)) {
		$sql = "INSERT INTO livro VALUES (default, '$titulo', '$gel', $autor, '$cdd', '$isbn', $exemp, '$data', '$capa', '$ccapa')";
	}else{
		$sql = "INSERT INTO livro VALUES (default, '$titulo', '$gel', $autor, '$cdd', '$isbn', $exemp, default, '$capa', '$ccapa')";
	}

	mysqli_query($con, $sql);

	$targetc = "_imagens/" . $capa;
	$targetcc = "_imagens/" . $ccapa;

	move_uploaded_file($_FILES["capa"]["tmp_name"], $targetc);
	move_uploaded_file($_FILES["contracapa"]["tmp_name"], $targetcc);

	header('Location: cadastro.php');
?>
