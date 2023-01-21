<?php
	include_once('autenticador.php');
	include_once('varcod.php');
	include_once('Conexao.php');

	include_once('funcoesGraficos.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BJB</title>
		<link rel="stylesheet" type="text/css" href="_css/estilo.css">
		<link rel="stylesheet" type="text/css" href="_css/grafico.css">
		<link rel="stylesheet" type="text/css" href="_css/listar.css">
		<link rel="stylesheet" type="text/css" href="_css/pendencias.css">
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
				
                <h2>Empréstimos gerais</h2>

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

				<h2>Empréstimos por séries</h2>

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

				<div class="bloco">
					<h2>Outros Dados</h2>

					<?php
						$sql = "SELECT permicao, count(permicao) AS empLeitor FROM emprestimo GROUP BY permicao";
											
						$r = mysqli_query($con, $sql);
						
						while ($result = mysqli_fetch_array($r)){
							if ($result['permicao'] == 'ALUNO') {
								$empAluno = $result['empLeitor'];
							}else{
								$empProf = $result['empLeitor'];
							}
						}
					?>
					<table class="visualizar2">

						<tr>
							<td class="Y">Emprestimos Absolutos:</td>
							<td class="X"><?php echo $empAluno + $empProf; ?></td>
						</tr>

						<tr>
							<td class="Y">Emprestimos para Alunos:</td>
							<td class="X"><?php echo $empAluno; ?></td>
						</tr>

						<tr>
							<td class="Y">Emprestimos Professores:</td>
							<td class="X"><?php echo $empProf; ?></td>
						</tr>
						
					</table>
				</div>

			</div>	
			
		</main>

	</body>
</html>

