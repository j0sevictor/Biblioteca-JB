<?php
	$ano = $_POST["ano"];
	$numero = $_POST["numero"];
	$turma = $_POST["turma"];
	$nome = $_POST["nome"];
	$livro = $_POST["nomelivro"];
	$dataemp = date('y-m-d');

	echo $livro;

	include_once("Conexao.php");

	$sql = "SELECT id FROM livro WHERE nome = '$livro'";
	$r = mysqli_query($con, $sql);
	if ($r) {
		if ($result = mysqli_fetch_array($r)) {
			$livro = $result["id"];
		}
	}

	$sql = "INSERT INTO emprestimoaluno VALUES (default, '$dataemp', $ano, '$turma', $numero, '$nome', $livro, 'Emprestado', default)";

	mysqli_query($con, $sql);


?>