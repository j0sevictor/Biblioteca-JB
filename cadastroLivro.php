<?php
	$gel = $_POST["genero"];
	$isbn = $_POST["isbn"];
	$titulo = $_POST["titulo"];
	$cdd = $_POST["cdd"];
	$autor = $_POST["nomeautor"];
	$data = $_POST["dataR"];
	$exemp = $_POST["exemp"];

	include_once("Conexao.php");

	$sql = "SELECT id FROM autor WHERE nome = '$autor'";
	$r = mysqli_query($con, $sql);
	if ($r) {
		if ($result = mysqli_fetch_array($r)) {
			$autor = $result["id"];
		}
	}

	$sql = "INSERT INTO Livro VALUES (default, '$titulo', '$gel', '$autor', '$cdd', '$isbn', $exemp, '$data')";

	mysqli_query($con, $sql);

	header("Location: cadastro.php");
?>
