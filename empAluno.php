<?php
	$ano = $_POST["ano"];
	$numero = $_POST["numero"];
	$turma = $_POST["turma"];
	$nome = $_POST["nome"];
	$livro = $_POST["livroId"];

	include_once("Conexao.php");

	$sql = "SELECT * FROM aluno WHERE ano = '$ano' AND turma = '$turma' AND numero = $numero";
	$result = mysqli_fetch_array(mysqli_query($con, $sql));

	if (!empty($result)) {
		$id = $result['id'];

		$sql = "INSERT INTO emprestimo VALUES (default, NOW(), $id, 'ALUNO', $livro, default, default)";
		mysqli_query($con, $sql);
	}else{
		$sql = "INSERT INTO aluno VALUES (default, $ano, '$turma', $numero, '$nome')";
		mysqli_query($con, $sql);
		
		$sql = "SELECT MAX(id) AS id FROM aluno";
		$result = mysqli_fetch_array(mysqli_query($con, $sql));
		$id = $result['id'];
		
		$sql = "INSERT INTO emprestimo VALUES (default, NOW(), $id, 'ALUNO', $livro, default, default)";
		mysqli_query($con, $sql);
	}

	header('Location: emprestimo.php');
?>