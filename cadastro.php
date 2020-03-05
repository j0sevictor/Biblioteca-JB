<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BJB</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
	</head>

	<body>

		<header class="cabecalho">
			<div id="logo">
				<img src="_imagens/logo.jpg" width="10%">
			</div>
		</header>	

		<nav class="menu">
			<ul id="links">
				<a href="cadastro.php" class="linkMenu"><li>Cadastro Livro/Autor</li></a> 
				<a href="" class="linkMenu"><li>Empréstimos</li></a>
				<a href="" class="linkMenu"><li>Devoluções</li></a>
				<a href="" class="linkMenu"><li>Pendências de Livros</li></a>
				<a href="" class="linkMenu"><li>Dados Gerais</li></a>
			</ul>
		</nav>

		<main class="conteudo">

			<div id="livro" class="formulario">
				<form action="cadastroLivro.php" method="POST">
					<h1>Cadastro de livros</h1>
					<table>
						
						<tr>
							<td>Título</td>
							<td><input type="text" name="titulo" id="titulo" placeholder="Título"></td>
						</tr>

						<tr>
							<td>Gênero</td>
							<td>
								<select name="genero" id="genero">
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
							<td>Autor</td>
							<td>
								<select name="nomeautor" id="nomeautor">
									<?php
										include_once('Conexao.php');
										$sql = 'SELECT * FROM autor';
										$r = mysqli_query($con, $sql);
										if ($r) {
											while ($result = mysqli_fetch_array($r)) {
									?>	
												<option value="<?php echo $result['nome'] ?>"><?php echo $result['nome'] ?></option>	
									<?php
												
											}
										}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td>ISBN</td>
							<td><input type="text" name="isbn" id="isbn" placeholder="ISBN do Livro"></td>
						</tr>


						<tr>
							<td>CDD</td>
							<td><input type="text" name="cdd" id="cdd" placeholder="CDD"></td>
						</tr>

						<tr>
							<td>Número de Exemplares</td>
							<td><input type="number" name="exemp" id="exemp"></td>
						</tr>


						<tr>
							<td>Data da Remessa</td>
							<td><input type="date" name="dataR" id="dataR" placeholder="Data de Chegada"></td>
						</tr>

						<tr>
							<td colspan="2"><input type="submit" value="Cadastrar"></td>
						</tr>
						
					</table>
				</form>
			</div>

			<div id="autor" class="formulario">
				<form action="cadastroAutor.php" method="POST">
					<h1>Autor</h1>
					<table>
						<tr>
							<td>Nome</td>
							<td><input type="text" name="nomeautor" id="nomeautor" placeholder="Nome"></td>
						</tr>

						<tr>
							<td>Descrição</td>
							<td><textarea id="desc" name="desc" placeholder=""></textarea></td>
						</tr>

						<tr>
							<td>Data Nascimento</td>
							<td><input type="date" name="datanasc" id="datanasc"></td>
						</tr>

						<tr>
							<td colspan="2"><input type="submit" value="Cadastrar"></td>
						</tr>

					</table>
				</form>
			</div>
		</main>

		<footer class="rodape">
			jn
		</footer>
	</body>
</html>