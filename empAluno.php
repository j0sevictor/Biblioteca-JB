<?php
	$ano = $_POST["ano"];
	$numero = $_POST["numero"];
	$turma = $_POST["turma"];
	$nome = $_POST["nome"];
	$livro = $_POST["livroId"];

	include_once("Conexao.php");

	$sql = "INSERT INTO emprestimoaluno VALUES (default, NOW(), $ano, '$turma', $numero, '$nome', $livro, default, default)";

	mysqli_query($con, $sql);

	header('Location: emprestimo.php');
?>