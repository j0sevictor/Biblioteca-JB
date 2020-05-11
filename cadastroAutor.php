<?php
	$nome = $_POST["nomeautor"];
	$desc = $_POST["desc"];
	$data = $_POST["datanasc"];

	include_once("Conexao.php");
	
	if (!empty($data)){
		$sql = "INSERT INTO autor VALUES (default, '$nome', '$data', '$desc')";
	}else{
		$sql = "INSERT INTO autor VALUES (default, '$nome', default, '$desc')";
	}
	

	mysqli_query($con, $sql);

	header("Location: cadastro.php");
?>