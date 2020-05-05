<?php
	$nome = $_POST["nomeautor"];
	$desc = $_POST["desc"];
	$data = $_POST["datanasc"];

	include_once("Conexao.php");

	$sql = "INSERT INTO autor VALUES (default, '$nome', '$data', '$desc')";

	mysqli_query($con, $sql);

	header("Location: cadastro.php");
?>