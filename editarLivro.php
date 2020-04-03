<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BJB</title>
		<link rel="stylesheet" type="text/css" href="_css/estilo.css">
		<link rel="shortcut icon" type="image/x-png" href="_imagens/logo.png">
	</head>

	<body>

		<header class="cabecalho">
			<div id="logo">
				<img src="_imagens/logo.png">
			</div>
		</header>	

		<nav class="menu">
			<ul id="links">
				<a href="cadastro.php" class="linkMenu"><li>Cadastro Livro/Autor</li></a> 
				<a href="listarLivros.php" class="linkMenu"><li>Listagem dos Livros/Autores</li></a>
				<a href="emprestimo.php" class="linkMenu"><li>Empréstimos</li></a>
				<a href="" class="linkMenu"><li>Devoluções</li></a>
				<a href="" class="linkMenu"><li>Pendências de Livros</li></a>
				<a href="" class="linkMenu"><li>Dados Gerais</li></a>
			</ul>
		</nav>

		<main class="conteudo">

			<div id="livro" class="formulario">
				<form action="cadastroLivro.php" enctype="multipart/form-data" method="POST">
					<h1>Edição de Dados: livro</h1>
					<table class="formulario">
						<?php
							include_once('Conexao.php');
							$sql = 'select livro.capa, livro.contra, livro.id, livro.titulo, livro.genero, autor.nome as autor, livro.cdd, livro.isbn, livro.exemplares, livro.dataRemessa
									from livro join autor
									on livro.autor = autor.id order by livro.titulo;';					
							$r = mysqli_query($con, $sql);
							if ($r) {
								if ($result = mysqli_fetch_array($r)) {
						?>
						<tr>
							<td>Título<input type="text" name="titulo" id="titulo" class="field" value="<?php echo $result['titulo'] ?>"></td>
						</tr>

						<tr>
							
							<td>Gênero
								<select name="genero" id="genero" class="field">
									<option value="Romance">Romance</option>
									<option value="Ficção Científica">Ficção Científica</option>
									<option value="Clássico">Clássico</option>
									<option value="Biografia">Biografia</option>
									<option value="AutoBiografia">AutoBiografia</option>
									<option value="Horro">Horror</option>
									<option value="Poesia">Poesia</option>
									<option value="Regionalismo">Regionalismo</option>
									<option value="Drama">Drama</option>
									<option value="Crônica">Crônica</option>
									<option value="Fábula">Fábula</option>
									<option value="Conto">Conto</option>
									<option value="Ensaio">Ensaio</option>
									<option value="Epopeia">Epopeia</option>
									<option value="Fantasia">Fantasia</option>
									<option value="Vampirismo">Vampirismo</option>
									<option value="Suspense">Suspense</option>
									<option value="Auto-Ajuda">Auto-Ajuda</option>
									<option value="Trajédia">Trajédia</option>
									<option value="Filosofia">Filosofia</option>
									<option value="Física">Física</option>
									<option value="Matemática">Matemática</option>
									<option value="Sociologia">Sociologia</option>
									<option value="HQ">HQ</option>
									<option value="Informática">Informática</option>
									<option value="Finanças">Finanças</option>
									<option value="Administração">Administração</option>
									<option value="Agropecuária">Agropecuária</option>
									<option value="Dicionários">Dicionários</option>
									<option value="Infantil">Infantil</option>
									<option value="Artes">Artes</option>
									<option value="Música">Música</option>
									<option value="Mitologia">Mitologia</option>
									<option value="Outro">Outro</option>
								</select>
							</td>
						</tr>

						<tr>
							
							<td>Autor
								<select name="nomeautor" id="nomeautor" class="field">
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
													<option value="<?php echo $result['nome'] ?>"><?php echo $result['nome'] ?></option>	
									<?php
												} else{
									?>
													<option value="<?php echo $result['nome'] ?>" selected7
													><?php echo $result['nome'] ?></option>
									<?php
												}
											}
										}
									?>
								</select>
							</td>
						</tr>

						<tr>
							
							<td>ISBN<input type="text" name="isbn" id="isbn" class="field"></td>
						</tr>


						<tr>
							
							<td>CDD<input type="text" name="cdd" id="cdd" class="field"></td>
						</tr>

						<tr>
							
							<td>Exemplares<input type="number" name="exemp" id="exemp" class="field"></td>
						</tr>


						<tr>
							
							<td>Data da Remessa<input type="date" class="field" name="dataR" id="dataR" ></td>
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
						
						<?php
								}
							}
						?>
					</table>
				</form>
			</div>

		</main>

		<footer class="rodape">
			jn
		</footer>
	</body>
</html>