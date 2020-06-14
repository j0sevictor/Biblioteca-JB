<?php
	include_once('autenticador.php');
	include_once('varcod.php');

	function intervalo_Data($data, $emprestado, $saberInt) {

		$datav = explode(' ', $data);
		$dataa = date('Y-m-d');

		$d1 = strtotime($datav[0]);
		$d2 = strtotime($dataa);

		$dataFinal = ($d2 - $d1) /86400;
		if (!$saberInt){
			if ($emprestado == 1){
				if ($dataFinal < 15){
					return 'verde';	
				}else if ($dataFinal >= 15 && $dataFinal < 30){
					return 'amarelo';
				}else{
					return 'vermelho';
				}
			}else{
				return 'azul';
			}
		}else{
			return $dataFinal;
		}
		
		
	}

	function mostrar_Linha($linhas_Titulos, $nome, $alunoid, $numero) {

		$vetorSize = count($linhas_Titulos);

		echo '<tr>';
			echo '<th rowspan="' . ($vetorSize + 1) . '"><a class="emplink" href="editarAP.php?id=' . $alunoid . '&tipo=1">' . $numero . '</a></th>';
			echo '<td rowspan="' . ($vetorSize + 1) . '">' . $nome . '</td>';
		echo '</tr>';
		for ($i = 0; $i < $vetorSize; $i++){
			echo '<tr>';
				echo $linhas_Titulos[$i];
			echo '</tr>';
		}

	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BJB</title>
		<link rel="stylesheet" type="text/css" href="_css/estilo.css">
		<link rel="stylesheet" type="text/css" href="_css/pendencias.css">
		<link rel="shortcut icon" type="image/x-png" href="_interface/logo.png">
		<script type="text/javascript" src="_javascript/funcoes.js"></script>
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

				<h1>Emprestimos</h1>
				
				<h2>Alunos</h2>
				<?php
					for ($p = 1; $p < 4; $p++){
						for ($q = 0; $q < 4; $q++) {
							echo '<a href="#' . $p . $valores[$q] . '" class="' . $valores[$q] . '">' . $p . '° ' . $cursos[$q] . '</a>';
						}
						echo '<br>';
					}
					echo '<a href="#P" class="P">Professores</a>';
					include_once('Conexao.php');
					
					$x = 1;
					while ($x <= 3){
						$y = 0;
						while ($y <= 3){
							echo('<h3 id="'. $x . $valores[$y] .'">' . $x . '° ' . $cursos[$y] . '</h3>');
							
							$sql = "SELECT aluno.nomeleitor, aluno.numero, livro.titulo, aluno.id AS alunoid, emprestimo.estado, emprestimo.dataemp, emprestimo.datadev, emprestimo.id AS empid
									FROM emprestimo JOIN livro JOIN aluno
									ON emprestimo.livroid = livro.id AND emprestimo.leitorid = aluno.id AND ano = '$x' AND turma = '$valores[$y]' AND permicao = 'ALUNO' ORDER BY numero";
							$r = mysqli_query($con, $sql);

							echo('<table class="pendencias">');
								$anterior = 100;
								$titulos = [];
								$i = 0;
								while ($result = mysqli_fetch_array($r)){

									if ($result['estado'] == 'Emprestado'){
										$situ = TRUE;
									}else{
										$situ = FALSE;
									}
									#CONCERTA O ERRO VICTOR - Burrroooo, 
									$estado = intervalo_Data($result['dataemp'], $situ, FALSE);
									$numero = $result['numero'];

									$linha = '<td class="' . $estado . '" title="Pego à '. intervalo_Data($result['dataemp'], $situ, TRUE) . ' dias"><a class="emplink" href="editarEmprestimo.php?id=' . $result['empid'] . '&tipo=1">' . $result['titulo'] . '</a></td>';
									
									if ($anterior == 100){
										$titulos[$i] = $linha;
										$i++;
									}else if ($anterior == $result['numero']) {
										$titulos[$i] = $linha;
										$i++;
										continue;
									}else {
										mostrar_Linha($titulos, $nome, $alunoid, $anterior);
										$titulos = [];
										$i = 0;
										$titulos[$i] = $linha;
										$i++;
									} 

									$anterior = $result['numero'];
									$nome = $result['nomeleitor'];
									$alunoid = $result['alunoid'];
								}
								if (!empty($titulos)){
									mostrar_Linha($titulos, $nome, $alunoid, $anterior);
								}
							echo('</table>');

							$y++;
						}
						
						$x++;
					}
				?>

				<h2 id="P">Professores</h2>

				<table class="pendencias">
					<?php
						$sql = "SELECT professor.nomeleitor, livro.titulo, emprestimo.estado, emprestimo.dataemp, emprestimo.datadev, professor.id AS pid, emprestimo.id AS empid
								FROM emprestimo JOIN livro JOIN professor
								ON emprestimo.livroid = livro.id AND emprestimo.leitorid = professor.id AND permicao = 'PROFESSOR' ORDER BY professor.nomeleitor, emprestimo.dataemp";
								
						$r = mysqli_query($con, $sql);

						while ($result = mysqli_fetch_array($r)){
							if ($result['estado'] == 'Emprestado'){
								$situ = TRUE;
							}else{
								$situ = FALSE;
							}
							$estado = intervalo_Data($result['dataemp'], $situ, FALSE);
					?>
							<tr>
								<td><a class="emplink" href="editarAP.php?id=<?php echo $result['pid']?>&tipo=0"><?php echo $result['nomeleitor']; ?></a></td>
								<td class="<?php echo $estado ?>" title="Pego à <?php echo intervalo_Data($result['dataemp'], $situ, TRUE); ?> dias"><a class="emplink" href="editarEmprestimo.php?id=<?php echo $result['empid'] ?>&tipo=0"><?php echo $result['titulo']; ?></a></td>
							</tr>

					<?php
						}
					?>
					
				</table>
				

			</div>

			
			
		</main>

	</body>
</html>

