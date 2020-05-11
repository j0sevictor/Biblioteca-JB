<?php
	$nome = $_POST["nome"];
	$livro = $_POST["livroId"];

	include_once("Conexao.php");

	$sql = "INSERT INTO emprestimoprof VALUES (default, NOW(), '$nome', $livro, default, default)";

	mysqli_query($con, $sql);

	header('Location: emprestimo.php');
?>