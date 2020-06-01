<?php
	include_once('autenticador.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BJB</title>
		<link rel="stylesheet" type="text/css" href="_css/estilo.css">
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
			<div class="bloco" class="formulario">
				<form action="cadastroAutor.php" enctype="multipart/form-data" method="POST">
					<h1>Autor</h1>
					<table class="formulario">
						<tr>							
							<td>Nome<input type="text" name="nomeautor" id="nomeautor" class="field"></td>
						</tr>

						<tr>
							<td><i>Descrição</i><textarea id="desc" name="desc" class="field"></textarea></td>
						</tr>

						<tr>
							<td><i>Nascimento</i><input type="date" class="field" name="datanasc" id="datanasc"></td>
						</tr>
						
						<tr>
							<td><input type="checkbox" value="true" name="autordomes" id="autordomes" OnChange="pegarFoto()"><label for="autordomes">Autor do Mês</label></td>
						</tr>

						<tr>
							<td><label class="file" for="fotoAutor" id="foto">Selecionar Foto do Autor</label><input type="file" name="fotoAutor" id="fotoAutor" class="file"></td>
						</tr>

						<tr>
							<th><input type="submit" class="enter" value="Cadastrar"></th>
						</tr>

					</table>
				</form>
			</div><!--
		
		--><div class="bloco" class="formulario">
				<form action="cadastroLivro.php" enctype="multipart/form-data" method="POST">
					<h1>Cadastro de livros</h1>
					<table class="formulario">
						
						<tr>
							
							<td>Título<input type="text" name="titulo" id="titulo" class="field"></td>
						</tr>

						<tr>
							
							<td>Gênero
								<select name="genero" id="genero" class="field">
									<option value="Indefinido">Selecione um Gênero</option>
								<?php
									include_once('varcod.php');

									foreach ($generos as $genero){
								?>
										<option value="<?php echo($genero); ?>"><?php echo($genero); ?></option>
								<?php
									}
								?>
								</select>
							</td>
						</tr>

						<tr>
							
							<td>Autor
								<select name="autor" id="autor" class="field">
									<?php
										include_once('Conexao.php');
										$sql = 'SELECT id, nome FROM autor ORDER BY nome';
										$sql2 = 'SELECT MAX(id) AS ultimo FROM autor';

										$r = mysqli_query($con, $sql);

										$r2 = mysqli_query($con, $sql2);
										$result2 = mysqli_fetch_array($r2);

										if ($r and $r2) {
											while ($result = mysqli_fetch_array($r)) {
												if ($result['id'] != $result2['ultimo']) {
									?>	
													<option value="<?php echo $result['id'] ?>"><?php echo $result['nome'] ?></option>	
									<?php
												} else{
									?>
													<option value="<?php echo $result['id'] ?>" selected><?php echo $result['nome'] ?></option>
									<?php
												}
											}
										}
									?>
								</select>
							</td>
						</tr>

						<tr>
							
							<td><i>ISBN<i><input type="text" name="isbn" id="isbn" class="field"></td>
						</tr>


						<tr>
							
							<td><i>CDD<i><input type="text" name="cdd" id="cdd" class="field"></td>
						</tr>

						<tr>
							
							<td>Exemplares<input type="number" name="exemp" id="exemp" class="field" value="0"></td>
						</tr>


						<tr>
							
							<td><i>Data da Remessa<i><input type="date" class="field" name="dataR" id="dataR" ></td>
						</tr>

						<tr>
							<td><label class="file" for="capa">Selecionar Capa</label><input type="file" name="capa" id="capa" class="file"></td>
						</tr>

						<tr>
							<td><label class="file" for="contracapa">Selecionar Contracapa</label><input type="file" name="contracapa" id="contracapa" class="file"></td>
						</tr>

						<tr>
							<th><input type="submit" class="enter" value="Cadastrar Livro"></th>
						</tr>
						
					</table>
				</form>
			</div>

		</main>

	</body>
</html>