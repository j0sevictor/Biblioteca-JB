<?php
	$nome = $_POST["nomeautor"];
	$desc = $_POST["desc"];
	$data = $_POST["datanasc"];
	$autmes = $_POST["autordomes"];

	include_once("Conexao.php");

	if (empty($autmes)){
		$autmes = 'default';
	}
	
	if (!empty($data)){
		$sql = "INSERT INTO autor VALUES (default, '$nome', '$data', '$desc', $autmes)";
	}else{
		$sql = "INSERT INTO autor VALUES (default, '$nome', default, '$desc', $autmes)";
	}
	

	mysqli_query($con, $sql);

	header("Location: cadastro.php");
?>