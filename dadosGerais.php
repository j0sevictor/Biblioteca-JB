<?php
	include_once('autenticador.php');
	include_once('varcod.php');
	include_once('Conexao.php');

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
			$t = strlen($tupla);
			$ntupla = '';
			for ($i = 0; $i <= $t; $i++){
				if ($i >= ($t - 2)) {
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
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BJB</title>
		<link rel="stylesheet" type="text/css" href="_css/estilo.css">
		<link rel="stylesheet" type="text/css" href="_css/grafico.css">
		<link rel="shortcut icon" type="image/x-png" href="_interface/logo.png">
		<script type="text/javascript" src="_javascript/funcoes.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	</head>

	<body>

		<header class="cabecalho">
			<div id="logo">
				<img src="_interface/logo.png" width="100%">
			</div>

		</header>	

		<?php include_once('menu.html'); ?>

		<main class="conteudo">

			<a href="#logo"><img src="_interface/subir.png" id="subir" title="Subir ao início"></a>

			<div id="lista">

				<h1>Dados das Turmas</h1>
				
                <h2>Emprestimos gerais</h2>

                <div class="grafico">
                	<canvas id="empsTotal"></canvas>

					<script type="text/javascript">	
						var ctx = document.getElementById("empsTotal").getContext("2d");
						var chart = new Chart(ctx, {
							type: 'line',

							data: {
								labels: [<?php echo empsTotal($con); ?>],
								datasets: [{
									label: 'Número Mensal de Emprestimos',
									borderColor: 'rgb(152, 200, 155)',
									data: [<?php echo empsTotal($con, FALSE); ?>],
									lineTension: 0
								}]
							},

							options: {}
						});
					</script>
				</div>

				<h2>Emprestimos por séries</h2>

				<div class="bloco">
                	<canvas id="empsTurmas"></canvas>

					<script type="text/javascript">	
						var ctx = document.getElementById("empsTurmas").getContext("2d");
						var chart = new Chart(ctx, {
							type: 'bar',

							data: {
								labels: ['1°', '2°', '3°'],
								datasets: [{
									label: 'Séries',
									barThickness: 80,
									backgroundColor: ['rgb(58, 157, 0)', 'rgb(255,55,11)', 'rgb(19,140,205)'],
									data: [<?php echo empsTurma($con, 1); ?>, <?php echo empsTurma($con, 2); ?>, <?php echo empsTurma($con, 3); ?>, 0]
								}]
							},

							options: {}
						});
					</script>
				</div><!--
		
			--><div class="bloco">

                	<canvas id="empsdev"></canvas>

					<script type="text/javascript">	
						var ctx = document.getElementById("empsdev").getContext("2d");
						var chart = new Chart(ctx, {
							type: 'pie',

							data: {
								labels: ['Entregues', 'Emprestados'],
								datasets: [{
									backgroundColor : ['rgba(19,140,205, 0.8)', 'rgba(255,55,11, 0.8)'],
									data: [<?php echo entregues($con); ?>, <?php echo entregues($con, FALSE); ?>]
								}]
							},

							options: {
								title: {
									display: true,
									text: 'Proporção de devoluções'
								}
							}
						});
					</script>
				</div>


				

			</div>	
			
		</main>

	</body>
</html>

