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
							
							$sql = "SELECT * FROM emprestimoaluno WHERE ano = $x, turma = '$cursos[$y]'";

							$r = mysqli_query($con, $sql);

							if ($r){

								echo('<table class="">');

									while ($result = mysqli_fetch_array($r)){
				?>
									<tr>
										<td>Foi?</td>
									</tr>

				<?php
						
									}
								echo('</table>');
							}

							$y++;
						}
						
						$x++;
					}
				?>
				

			</div>

			
			
		</main>

		<footer class="rodape">
			jn
		</footer>
	</body>
</html>