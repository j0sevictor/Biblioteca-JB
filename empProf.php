<?php
	$nome = $_POST["nome"];
	$livro = $_POST["livroId"];

	include_once("Conexao.php");

	$sql = "INSERT INTO professor VALUES (default, '$nome')";
	mysqli_query($con, $sql);

	$sql = "SELECT MAX(id) AS id FROM professor";
	$result = mysqli_fetch_array(mysqli_query($con, $sql));
	$id = $result['id'];

	$sql = "INSERT INTO emprestimo VALUES (default, NOW(), $id, 'PROFESSOR', $livro, default, default)";
	mysqli_query($con, $sql);

	header('Location: emprestimo.php');
?>