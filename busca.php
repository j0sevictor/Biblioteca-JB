<?php
	include_once('Conexao.php');

	$livro = $_POST['palavra'];
	
	$sql = "SELECT id, titulo FROM livro WHERE titulo LIKE '%$livro%'";
	$r = mysqli_query($con, $sql);
	
	if(mysqli_num_rows($r) <= 0){
		echo "<option>Nenhum livro encontrado</option>";
	}else{
		while($result = mysqli_fetch_array($r)){
			echo '<option value="' . $result['id'] . '">'. $result['titulo'] . '</option>';
		}
	}
?>