<?php
	$nome = $_POST["nome"];
	$livro = $_POST["nomelivro"];
	$dataemp = date('y-m-d');

	include_once("Conexao.php");

	$sql = "SELECT id FROM livro WHERE titulo = '$livro'";
	$r = mysqli_query($con, $sql);
	if ($r) {
		if ($result = mysqli_fetch_array($r)) {
			$livro = $result["id"];
		}
	}

	$sql = "INSERT INTO emprestimoprof VALUES (default, '$dataemp', $nome', $livro, 'Emprestado', default)";

	mysqli_query($con, $sql);

	header("Location: emprestimo.php");
?>