<?php

    function empsTotal($con, $meses=TRUE){
		if ($meses) {

			$sql = "SELECT dataemp FROM emprestimo WHERE permicao = 'ALUNO' ORDER BY dataemp";
			$r = mysqli_query($con, $sql);

			$tupla = '';
			$datas = [];
			while ($result = mysqli_fetch_array($r)){
				$mes = $result['dataemp'][5] . $result['dataemp'][6];

				if (!in_array($mes, $datas)) {
					if ($mes == '01') {
						$tupla .= "'JAN', ";
					}elseif ($mes == '02') {
						$tupla .= "'FEV', ";
					}elseif ($mes == '03') {
						$tupla .= "'MAR', ";
					}elseif ($mes == '04') {
						$tupla .= "'ABR', ";
					}elseif ($mes == '05') {
						$tupla .= "'MAI', ";
					}elseif ($mes == '06') {
						$tupla .= "'JUN', ";
					}elseif ($mes == '07') {
						$tupla .= "'JUL', ";
					}elseif ($mes == '08') {
						$tupla .= "'AGO', ";
					}elseif ($mes == '09') {
						$tupla .= "'SET', ";
					}elseif ($mes == '10') {
						$tupla .= "'OUT', ";
					}elseif ($mes == '11') {
						$tupla .= "'NOV', ";
					}elseif ($mes == '12') {
						$tupla .= "'DEZ', ";
					}

					$datas[] = $mes;
				}
			}

			$t = strlen($tupla) - 2;
			$ntupla = '';
			for ($i = 0; $i <= $t; $i++){
				if ($i >= $t) {
					continue;
				}
				$ntupla .= $tupla[$i]; 
			}
			return $ntupla;
		}else{
			$sql = "SELECT dataemp FROM emprestimo WHERE permicao = 'ALUNO' ORDER BY dataemp";
			$r = mysqli_query($con, $sql);

			$tupla = array(
				'jan' => 0,
				'fev' => 0,
				'mar' => 0,
				'abr' => 0,
				'mai' => 0,
				'jun' => 0,
				'jul' => 0,
				'ago' => 0,
				'set' => 0,
				'out' => 0,
				'nov' => 0,
				'dez' => 0
			);
			while ($result = mysqli_fetch_array($r)){
				$mes = $result['dataemp'][5] . $result['dataemp'][6];

				if ($mes == '01') {
					$tupla['jan']++;
				}elseif ($mes == '02') {
					$tupla['fev']++;
				}elseif ($mes == '03') {
					$tupla['mar']++;
				}elseif ($mes == '04') {
					$tupla['abr']++;
				}elseif ($mes == '05') {
					$tupla['mai']++;
				}elseif ($mes == '06') {
					$tupla['jun']++;
				}elseif ($mes == '07') {
					$tupla['jul']++;
				}elseif ($mes == '08') {
					$tupla['ago']++;
				}elseif ($mes == '09') {
					$tupla['set']++;
				}elseif ($mes == '10') {
					$tupla['out']++;
				}elseif ($mes == '11') {
					$tupla['nov']++;
				}elseif ($mes == '12') {
					$tupla['dez']++;
				}	
			}
			$ntupla = '';
			foreach($tupla as $mes){
				if ($mes != 0){
					$ntupla .= "$mes, "; 
				}
			}
			$t = strlen($ntupla);
			$nntupla = '';
			for ($i = 0; $i <= $t; $i++){
				if ($i >= ($t - 2)) {
					continue;
				}
				$nntupla .= $ntupla[$i]; 
			}
			return $nntupla;
		}
	}

	function empsTurma($con, $serie){
		$sql = "SELECT count(*) AS numEmp FROM 
				emprestimo JOIN aluno
				ON emprestimo.leitorid = aluno.id AND permicao = 'ALUNO' AND ano = $serie";
		$r = mysqli_query($con, $sql);
		
		if ($result = mysqli_fetch_array($r)) {
			return $result['numEmp'];
		}else{
			return 0;
		}
	}
	
	function entregues($con, $entregue=TRUE){
		if ($entregue) {
			$sql = "SELECT count(*) AS numEnt FROM emprestimo
					WHERE permicao = 'ALUNO' AND estado = 'Entregue'";
			$r = mysqli_query($con, $sql);
			if ($result = mysqli_fetch_array($r)) {
				return $result['numEnt'];
			}else{
				return 0;
			}
		}else{
			$sql = "SELECT count(*) AS numEmp FROM emprestimo
					WHERE permicao = 'ALUNO' AND estado = 'Emprestado'";
			$r = mysqli_query($con, $sql);
			if ($result = mysqli_fetch_array($r)) {
				return $result['numEmp'];
			}else{
				return 0;
			}
		}
	}
	
	function generos($con, $meses=TRUE){
		if ($meses) {

			$sql = 'SELECT livro.genero FROM emprestimo JOIN livro
					ON livro.id = emprestimo.leitorid GROUP BY livro.genero';
			$r = mysqli_query($con, $sql);

			$tupla = '';
			while ($result = mysqli_fetch_array($r)){
				$tupla .= "'" . $result['genero'] . "', "; 
			}

			$t = strlen($tupla) - 2;
			$ntupla = '';
			for ($i = 0; $i <= $t; $i++){
				if ($i >= $t) {
					continue;
				}
				$ntupla .= $tupla[$i]; 
			}

			return $ntupla;	
		}else{
			
			$sql = 'SELECT COUNT(livro.genero) AS leituras 
					FROM emprestimo JOIN livro
					ON livro.id = emprestimo.livroid GROUP BY livro.genero';
			$r = mysqli_query($con, $sql);

			$tupla = '';
			while ($result = mysqli_fetch_array($r)){
				$tupla .= $result['leituras'] . ', '; 
			}
			
			$t = strlen($tupla) - 2;
			$ntupla = '';
			for ($i = 0; $i <= $t; $i++){
				if ($i >= $t) {
					continue;
				}
				$ntupla .= $tupla[$i]; 
			}

			return $ntupla;
		}
	}

	function maisLidos($con, $numeros=TRUE){
		if ($numeros) {
			$sql = 'SELECT COUNT(emprestimo.livroid) AS numero
					FROM emprestimo JOIN livro
					ON livro.id = emprestimo.livroid GROUP BY livro.titulo ORDER BY numero DESC';
			$r = mysqli_query($con, $sql);

			$tupla = '';
			for ($i = 0; $i <= 9; $i++){
				if ($result = mysqli_fetch_array($r)){
					$tupla .= $result['numero'] . ", ";
				} 
			}

			$t = strlen($tupla) - 2;
			$ntupla = '';
			for ($i = 0; $i <= $t; $i++){
				if ($i >= $t) {
					continue;
				}
				$ntupla .= $tupla[$i]; 
			}

			return $ntupla;
		}else{
			$sql = 'SELECT livro.titulo, COUNT(emprestimo.livroid) AS numero
					FROM emprestimo JOIN livro
					ON livro.id = emprestimo.livroid GROUP BY livro.titulo ORDER BY numero DESC';
			$r = mysqli_query($con, $sql);

			$tupla = '';
			for ($i = 0; $i <= 9; $i++){
				if ($result = mysqli_fetch_array($r)){
					$tupla .= "'" . $result['titulo'] . "', "; 
				}
			}

			$t = strlen($tupla) - 2;
			$ntupla = '';
			for ($i = 0; $i <= $t; $i++){
				if ($i >= $t) {
					continue;
				}
				$ntupla .= $tupla[$i]; 
			}

			return $ntupla;
		}
	}

	function maisLidosAutores($con, $numeros=TRUE){
		if ($numeros) {
			$sql = 'SELECT COUNT(autor.id) AS numero
					FROM emprestimo JOIN livro JOIN autor
					ON livro.id = emprestimo.livroid AND livro.autor = autor.id GROUP BY autor.nome ORDER BY numero DESC;';
			$r = mysqli_query($con, $sql);

			$tupla = '';
			for ($i = 0; $i <= 9; $i++){
				if ($result = mysqli_fetch_array($r)){
					$tupla .= $result['numero'] . ", ";
				} 
			}

			$t = strlen($tupla) - 2;
			$ntupla = '';
			for ($i = 0; $i <= $t; $i++){
				if ($i >= $t) {
					continue;
				}
				$ntupla .= $tupla[$i]; 
			}

			return $ntupla;
		}else{
			$sql = 'SELECT autor.nome, COUNT(autor.id) AS numero
					FROM emprestimo JOIN livro JOIN autor
					ON livro.id = emprestimo.livroid AND livro.autor = autor.id GROUP BY autor.nome ORDER BY numero DESC;';
			$r = mysqli_query($con, $sql);

			$tupla = '';
			for ($i = 0; $i <= 9; $i++){
				if ($result = mysqli_fetch_array($r)){
					$tupla .= "'" . $result['nome'] . "', "; 
				}
			}

			$t = strlen($tupla) - 2;
			$ntupla = '';
			for ($i = 0; $i <= $t; $i++){
				if ($i >= $t) {
					continue;
				}
				$ntupla .= $tupla[$i]; 
			}

			return $ntupla;
		}
	}
    
?>