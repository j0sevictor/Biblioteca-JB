<?php
	include_once('Conexao.php');

	$livro = $_POST['palavra'];
	
	$sql = "SELECT titulo FROM livro WHERE titulo LIKE '%$livro%'";
	$r = mysqli_query($con, $sql);
	
	if(mysqli_num_rows($r) <= 0){
		echo "Nenhum livro encontrado...";
	}else{
		while($result = mysqli_fetch_array($r)){
			echo "<li>".$result['titulo']."</li>";
		}
	}
?>