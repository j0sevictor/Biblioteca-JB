<?php
	$nome = $_POST["nomeautor"];
	$desc = $_POST["desc"];
	$data = $_POST["datanasc"];
	$autmes = $_POST["autordomes"];

	$foto = $_FILES["fotoAutor"]["name"];

	include_once("Conexao.php");

	if (empty($autmes)){
		$autmes = 'default';
	}
	
	if (!empty($data)){
		$sql = "INSERT INTO autor VALUES (default, '$nome', '$data', '$desc', $autmes, '$foto')";
	}else{
		$sql = "INSERT INTO autor VALUES (default, '$nome', default, '$desc', $autmes, '$foto')";
	}
	

	mysqli_query($con, $sql);

	$target = "_imagens/" . $foto;
	move_uploaded_file($_FILES["fotoAutor"]["tmp_name"], $target);

	header("Location: cadastro.php");
?>