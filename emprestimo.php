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
				<img src="_imagens/logo.png" width="100%">
			</div>
			<div id="titulo">
				<h2>Página de Gerenciamento</h2>
			</div>
		</header>	

		<nav class="menu">
			<ul id="links">
				<a href="cadastro.php" class="linkMenu"><li>Cadastro Livro/Autor</li></a> 
				<a href="listarLivros.php" class="linkMenu"><li>Listagem dos Livros/Autores</li></a>
				<a href="emprestimos.php" class="linkMenu"><li>Empréstimos</li></a>
				<a href="" class="linkMenu"><li>Devoluções</li></a>
				<a href="" class="linkMenu"><li>Pendências de Livros</li></a>
				<a href="" class="linkMenu"><li>Dados Gerais</li></a>
			</ul>
		</nav>

		<main class="conteudo">

			<div id="livro" class="formulario">
				<form action="empAluno.php" method="POST">
					<h1>Empréstimos para Alunos</h1>
					<table class="formulario">
						
						<tr>
							
							<td>Ano
								<select name="ano" id="ano" class="field">
									<option value="1">1°</option>
									<option value="2">2°</option>
									<option value="3">3°</option>
								</select></td>
						</tr>

						<tr>
							
							<td>Turma
								<select name="turma" id="turma" class="field">
									<option value="Informática">Informática</option>
									<option value="Finanças">Finanças</option>
									<option value="Agropecuária">Agropecuária</option>
									<option value="Administração">Administração</option>
								</select>
							</td>
						</tr>


						<tr>
							
							<td>Número<input type="number" name="numero" id="numero" class="field"></td>
						</tr>

						<tr>
							<td>Nome<input type="text" name="nome" id="nome" class="field"></td>
						</tr>

						<tr>
							
							<td>Livro
								<select name="ivro" id="livro" class="field">
									<?php
										include_once('Conexao.php');
										$sql = 'SELECT * FROM livro';
										$r = mysqli_query($con, $sql);
										if ($r) {
											while ($result = mysqli_fetch_array($r)) {
									?>	
												<option value="<?php echo $result['titulo'] ?>"><?php echo $result['titulo'] ?></option>	
									<?php
												
											}
										}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<th><input type="submit" class="enter" value="Emprestar Livro"></th>
						</tr>
						
					</table>
				</form>
			</div>

			<div id="livro" class="formulario">
				<form action="empProf.php" method="POST">
					<h1>Empréstimos para Professores</h1>
					<table class="formulario">
						
						<tr>
							<td>Nome<input type="text" name="nome" id="nome" class="field"></td>
						</tr>

						<tr>
							
							<td>Livro
								<select name="ivro" id="livro" class="field">
									<?php
										include_once('Conexao.php');
										$sql = 'SELECT * FROM livro';
										$r = mysqli_query($con, $sql);
										if ($r) {
											while ($result = mysqli_fetch_array($r)) {
									?>	
												<option value="<?php echo $result['titulo'] ?>"><?php echo $result['titulo'] ?></option>	
									<?php
												
											}
										}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<th><input type="submit" class="enter" value="Emprestar Livro"></th>
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