<?php
	include_once('autenticador.php');
	include_once('varcod.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BJB</title>
		<link rel="stylesheet" type="text/css" href="_css/estilo.css">
		<link rel="shortcut icon" type="image/x-png" href="_imagens/logo.png">
		<script type="text/javascript" src="_javascript/funcoes.js"></script>
	</head>

	<body>

		<header class="cabecalho">
			<div id="logo">
				<img src="_imagens/logo.png" width="100%">
			</div>

		</header>	

		<?php include_once('menu.html'); ?>

		<main class="conteudo">
			<div id="lista">

				<h1>Emprestimos</h1>
				
				<h2>Alunos</h2>

				<?php
					include_once('Conexao.php');

					$x = 1;
					while ($x <= 3){
						$y = 0;
						while ($y <= 3){
							echo('<h3>' . $x . '° ' . $cursos[$y] . '</h3>');
							
							$sql = "SELECT * FROM emprestimoaluno WHERE ano = '$x' AND turma = '$cursos[$y]' AND estado = 'Emprestado' ORDER BY numero";

							$r = mysqli_query($con, $sql);

							if ($r){

								echo('<table border="1px" class="pendencias">');
									$anterior = 100;
									while ($result = mysqli_fetch_array($r)){

										if ($anterior == $result['numero']) {
											echo '<li>' . $result['livroid'] . '</li>';
											continue;
										}else if ($anterior != 100){
											echo '</ul></td></tr>';
										}
				?>
										<tr>
											<th><?php echo $result['numero']; ?></th>
											<td><?php echo $result['nomeleitor']; ?></td>
											<td>
												<ul>
													<li><?php echo $result['livroid']; ?></li>

				<?php
										$anterior = $result['numero'];
									}
									echo '</ul></td></tr>';
								echo('</table>');
							}

							$y++;
						}
						
						$x++;
					}
				?>

				<h2>Professores</h2>

				<table border="1px" class="pendencias">
					<?php
						$sql = 'SELECT * FROM emprestimoprof';
						$r = mysqli_query($con, $sql);

						$anterior = '';
						while ($result = mysqli_fetch_array($r)){
							if ($anterior == $result['nomeleitor']) {
								echo '<li>' . $result['livroid'] . '</li>';
								continue;
							}else if ($anterior != 100){
								echo '</ul></td></tr>';
							}
					?>
							<tr>
								<td><?php echo $result['nomeleitor']; ?></td>
								<td>
									<ul>
										<li><?php echo $result['livroid']; ?></li>

					<?php
							$anterior = $result['nomeleitor'];
						}
						echo '</ul></td></tr>';
					?>
					
				</table>
				

			</div>

			
			
		</main>

		<footer class="rodape">
			jn
		</footer>
	</body>
</html>