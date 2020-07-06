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
		<link rel="stylesheet" type="text/css" href="_css/emprestimo.css">
		<link rel="stylesheet" type="text/css" href="_css/listar.css">
		<link rel="shortcut icon" type="image/x-png" href="_interface/logo.png">
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
		<script type="text/javascript" src="_javascript/pesquisa.js"></script>
	</head>

	<body>

		<header class="cabecalho">
			<div id="logo">
				<img src="_interface/logo.png" width="100%">
			</div>

		</header>	

		<?php include_once('menu.html'); ?>

		<main class="conteudo">
			<div class="bloco">			
				<h1>Devolução para Alunos</h1>
				<table class="formulario">
				<?php
					include_once('Conexao.php');
					if (isset($_GET['tipo'])) {
						if ($_GET['tipo'] == 'ALUNO') {
							$get = TRUE;
	
							$id = $_GET['leitorid'];
	
							$sql = "SELECT ano, turma, numero FROM aluno WHERE id = $id";
							$result = mysqli_fetch_array(mysqli_query($con, $sql));
						}else{
							$get = FALSE;
						}
					}else{
						$get = FALSE;
					}
				?>
					<tr>
						<td>Ano
							<select name="ano" id="ano" class="field">
								<?php
									$anos = ['1', '2', '3'];
									foreach ($anos as $ano){
										if ($get) {
											if ($result['ano'] == $ano) {
												echo '<option value="' . $ano . '" selected>' . $ano . '°' . '</option>';
											}else{
												echo '<option value="' . $ano . '">' . $ano . '°' . '</option>';
											}
										}else{
											echo '<option value="' . $ano . '">' . $ano . '°' . '</option>';
										}
									}
								?>
							</select></td>
					</tr>

					<tr>
						<td>Turma
							<select name="turma" id="turma" class="field">
								<?php
									for ($i = 0; $i <= 3; $i++){
										if ($get) {
											if ($result['turma'] == $valores[$i]) {
												echo '<option value="' . $valores[$i] . '" selected>' . $cursos[$i] . '</option>';
											}else{
												echo '<option value="' . $valores[$i] . '">' . $cursos[$i] . '</option>';
											}
										}else{
											echo '<option value="' . $valores[$i] . '">' . $cursos[$i] . '</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>


					<tr>
						
						<td>Número<input type="number" name="numero" id="numero" class="field" value='<?php if ($get){ echo $result['numero']; }else { echo '1'; } ?>'></td>
					</tr>

					<tr>
						<th><input type="submit" id="btPesquisa" class="enter" value="Pesquisar dados"></th>
					</tr>
					
				</table>
			</div><!--
		
		--><div class="bloco">
				<div id="emprestimosaluno">
					
				
				</div>

				<script type="text/javascript">
					function abrirTelaDevolverAluno(id)
					{
						var nome = document.getElementById('nomeleitor').innerHTML;
						var titulo = document.getElementById('titulo' + id).innerHTML;

						var r = confirm('Você deseja Efetuar a Devolução de "' + titulo + '" para ' + nome);

						if (r){
							window.location.href = "devolver.php?id=" + id;	
						}
					}
				</script>
			</div>
			
			<div class="bloco">
				<div class="formulario">
		
					<h1>Devolução para Professores</h1>
					<table class="formulario">
					<?php
						if (isset($_GET['tipo'])) {
							if ($_GET['tipo'] == 'PROFESSOR') {
								$get2 = TRUE;
		
								$id = $_GET['leitorid'];
		
								$sql = "SELECT nomeleitor FROM professor WHERE id = $id";
								$result2 = mysqli_fetch_array(mysqli_query($con, $sql));
							}else{
								$get2 = FALSE;
							}
						}else{
							$get2 = FALSE;
						}
					?>
						<tr>
							<td>Nome
								<select name="nomeProf" id="nomeProf" class="field">
									<?php
										
										$sql = "SELECT professor.nomeleitor 
												FROM professor JOIN emprestimo 
												ON professor.id = emprestimo.leitorid AND emprestimo.estado = 'Emprestado' AND emprestimo.permicao = 'PROFESSOR' ORDER BY nomeleitor";

										$r = mysqli_query($con, $sql);

										if ($r) {
											while ($result = mysqli_fetch_array($r)) {
												if ($get2){
													if ($result2['nomeleitor'] == $result['nomeleitor']) {
														echo '<option value="' . $result['nomeleitor'] . '" selected>' . $result['nomeleitor'] . '</option>';
													}else {
														echo '<option value="' . $result['nomeleitor'] . '">' . $result['nomeleitor'] . '</option>';
													}													
												}else {
													echo '<option value="' . $result['nomeleitor'] . '">' . $result['nomeleitor'] . '</option>';
												}												
											}
										}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<th><input type="submit" id="btPesquisaProf" class="enter" value="Pesquisar dados"></th>
						</tr>
						
					</table>
				</div>		
			</div><!--
		
		--><div class="bloco">
				<div id="emprestimosprof"> 
								
				
				</div>

				<script type="text/javascript">
					function abrirTelaDevolverProf(id)
					{
						var nome = document.getElementById('nomeleitorP').innerHTML;
						var titulo = document.getElementById('tituloP' + id).innerHTML;

						var r = confirm('Você deseja Efetuar a Devolução de "' + titulo + '" para ' + nome);

						if (r){
							window.location.href = 'devolver.php?id=' + id;	
						}
					}
				</script>
			</div>



		</main>

	</body>
</html>