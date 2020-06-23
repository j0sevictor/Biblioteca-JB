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
		<link rel="stylesheet" type="text/css" href="_css/listar.css">
		<link rel="shortcut icon" type="image/x-png" href="_interface/logo.png">
	</head>

	<body>

		<header class="cabecalho">
			<div id="logo">
				<img src="_interface/logo.png">
			</div>
		</header>	

		<?php include_once('menu.html'); ?>

		<main class="conteudo">

			<div class="bloco">
				<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><img src="_interface/voltar.png" id="voltar" title="Voltar à página anterior"></a>
				<h2>Dados Atuais</h2>
				<?php
					$id = $_GET['id'];

					include_once('Conexao.php');
					$sql = "select livro.capa, livro.contra, livro.id, livro.titulo, livro.genero, autor.nome as autor, autor.id AS autorid, livro.cdd, livro.isbn, livro.exemplares, livro.dataRemessa
							from livro join autor
							on livro.autor = autor.id where livro.id = $id order by livro.titulo";					
					$r = mysqli_query($con, $sql);
					$result = mysqli_fetch_array($r);
				?>
				<table class="visualizar">
					<tr>
						<td class="livroM"><img class="livro" src="<?php if (!empty($result["capa"])){ echo '_imagens/' . $result['capa']; }else{ echo '_interface/livroOculto.png'; } ?>"></td>
						<td class="livroM"><img class="livro" src="<?php if (!empty($result["contra"])){ echo '_imagens/' . $result['contra']; }else{ echo '_interface/livroOculto.png'; } ?>"></td>
					</tr>

					<tr>
						<td class="Y">Título:</td>
						<td class="X" colspan="2"><?php echo $result["titulo"]; ?></td>
					</tr>

					<tr>
						<td class="Y">Gênero:</td>
						<td class="X" colspan="2"><?php echo $result["genero"]; ?></td>
					</tr>

					<tr>
						<td class="Y">Autor:</td>
						<td class="XL" colspan="2"><a class="emplink" href="editarAutor.php?id=<?php echo $result['autorid'] ?>"><?php echo $result["autor"]; ?></a></td>
					</tr>

					<tr>
						<td class="Y">ISBN:</td>
						<td class="X" colspan="2">ISBN<?php echo $result["isbn"]; ?></td>
					</tr>

					<tr>
						<td class="Y">CDD:</td>
						<td class="X" colspan="2"><?php echo $result["cdd"]; ?></td>
					</tr>

					<tr>
						<td class="Y">N° de exemplares:</td>
						<td class="X" colspan="2"><?php echo $result["exemplares"]; ?></td>
					</tr>

					<tr>
						<td class="Y">Data da Remessa:</td>
						<td class="X" colspan="2"><?php echo $result["dataRemessa"]; ?></td>
					</tr>	
				</table>
			</div><!--
		
		--><div class="bloco">
				<form action="edicao.php" enctype="multipart/form-data" method="POST">
					<h2>Edição de Dados</h2>
					<table class="formulario">
						<tr>
							<td>Título<input type="text" name="titulo" id="titulo" class="field" value="<?php echo $result['titulo'] ?>"></td>
						</tr>

						<tr>
							
							<td>Gênero
								<select name="genero" id="genero" class="field">
									<option value="Indefinido">Selecione um Gênero</option>
								<?php
									include_once('varcod.php');

									foreach ($generos as $genero){
										if ($result['genero'] == $genero){
											echo '<option value="' . $genero . '" selected>' . $genero . '</option>';
										}else{
											echo '<option value="' . $genero . '">' . $genero . '</option>';
										}
									}
								?>
								</select>
							</td>
						</tr>

						<tr>
							
							<td>Autor
								<select name="nomeautor" id="nomeautor" class="field">
									<?php
										$sql = 'SELECT id, nome FROM autor ORDER BY nome';

										$r = mysqli_query($con, $sql);

										if ($r) {
											while ($result2 = mysqli_fetch_array($r)) {
												if ($result2['nome'] != $result['autor']) {
									?>	
													<option value="<?php echo $result2['id'] ?>"><?php echo $result2['nome'] ?></option>	
									<?php
												} else{
									?>
													<option value="<?php echo $result2['id'] ?>" selected><?php echo $result2['nome'] ?></option>
									<?php
												}
											}
										}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td>ISBN<input type="text" name="isbn" id="isbn" class="field" value="<?php echo $result["isbn"]; ?>"></td>
						</tr>


						<tr>
							
							<td>CDD<input type="text" name="cdd" id="cdd" class="field" value="<?php echo $result["cdd"]; ?>"></td>
						</tr>

						<tr>
							
							<td>Exemplares<input type="number" name="exemp" id="exemp" class="field" value="<?php echo $result["exemplares"]; ?>"></td>
						</tr>


						<tr>
							
							<td>Data da Remessa<input type="date" class="field" name="dataR" id="dataR" value="<?php echo $result["dataRemessa"]; ?>"></td>
						</tr>

						<tr>
							<td><label class="file" for="capa">Atualizar Capa</label><input type="file" name="capa" id="capa" class="file"></td>
						</tr>

						<tr>
							<td><label class="file" for="contracapa">Atualizar Contracapa</label><input type="file" name="contracapa" id="contracapa" class="file"></td>
						</tr>

						<tr>
							<th><input type="submit" class="enter" value="Atualizar o Livro"></th>
						</tr>

					</table>
					<input type="hidden" name="formulario" value="LIVRO">
					<input type="hidden" name="id" value="<?php echo $result['id'] ?>">
				</form>
			</div>

			<div class="duploB">
				<h1>Está emprestado para:</h1>
				
				<table class="lista" id="expandir">
					<tr>
						<th>Nome</th>
						<th>Número</th>
						<th>Ano</th>
						<th>Turma</th>
						<th>Data e hora do Emprestimo</th>
					</tr>
					<?php
						$sql = "SELECT aluno.nomeleitor, aluno.numero, aluno.ano, aluno.turma, emprestimo.dataemp, aluno.id AS alunoid, emprestimo.id AS empid
								FROM emprestimo JOIN aluno
								ON emprestimo.leitorid = aluno.id AND permicao = 'ALUNO' AND emprestimo.livroid = $id ORDER BY aluno.ano, aluno.turma";
						$r = mysqli_query($con, $sql);
						$x = TRUE;
						while($result = mysqli_fetch_array($r)){
							for ($i = 0; $i <= 3; $i++){
								if ($result['turma'] == $valores[$i]) {
									$turma = $cursos[$i];
								}
							}
							if ($x){
					?>
							<tr>
								<td class="X"><?php echo $result['nomeleitor']; ?></td>
								<td class="XL"><a class="emplink" href="editarAP.php?id=<?php echo $result['alunoid']; ?>&tipo=1"><?php echo $result['numero']; ?></a></td>
								<td class="X"><?php echo $result['ano']; ?>°</td>
								<td class="X"><?php echo $turma; ?></td>
								<td class="XL"><a class="emplink" href="editarEmprestimo.php?id=<?php echo $result['empid']; ?>&tipo=1"><?php echo $result['dataemp']; ?></a></td>
							</tr>
					<?php 
							}else{
					?>
								<tr>
									<td class="Y"><?php echo $result['nomeleitor']; ?></td>
									<td class="YL"><a class="emplink" href="editarAP.php?id=<?php echo $result['alunoid']; ?>&tipo=1"><?php echo $result['numero']; ?></a></td>
									<td class="Y"><?php echo $result['ano']; ?>°</td>
									<td class="Y"><?php echo $turma; ?></td>
									<td class="YL"><a class="emplink" href="editarEmprestimo.php?id=<?php echo $result['empid']; ?>&tipo=1"><?php echo $result['dataemp']; ?></a></td>
								</tr>
					<?php 
							}
							if ($x) {
								$x = FALSE;
							}else{
								$x = TRUE;
							}
						}

						$sql = "SELECT professor.nomeleitor, emprestimo.dataemp, professor.id AS profid, emprestimo.id AS empid
								FROM emprestimo JOIN professor
								ON emprestimo.leitorid = professor.id AND permicao = 'PROFESSOR' AND emprestimo.livroid = $id ORDER BY professor.nomeleitor";
						$r = mysqli_query($con, $sql);
						while($result = mysqli_fetch_array($r)){
							if ($x){
					?>
								<tr>
									<td class="XL"><a class="emplink" href="editarAP.php?id=<?php echo $result['profid']; ?>&tipo=0"><?php echo $result['nomeleitor']; ?></a></td>
									<td class="X" colspan="3">Professor</td>
									<td class="XL"><a class="emplink" href="editarEmprestimo.php?id=<?php echo $result['empid']; ?>&tipo=0"><?php echo $result['dataemp']; ?></a></td>
								</tr>
					<?php 
							}else{
					?>
								<tr>
									<td class="YL"><a class="emplink" href="editarAP.php?id=<?php echo $result['profid']; ?>&tipo=0"><?php echo $result['nomeleitor']; ?></a></td>
									<td class="Y" colspan="3">Professor</td>
									<td class="YL"><a class="emplink" href="editarEmprestimo.php?id=<?php echo $result['empid']; ?>&tipo=0"><?php echo $result['dataemp']; ?></a></td>
								</tr>
				<?php 
							}
							if ($x) {
								$x = FALSE;
							}else{
								$x = TRUE;
							}
						}
				?>


				</table>
			<div>

		</main>

	</body>
</html>