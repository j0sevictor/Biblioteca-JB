<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BJB</title>
		<link rel="stylesheet" type="text/css" href="_css/estilo.css">
		<link rel="stylesheet" type="text/css" href="_css/listar.css">
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
				<a href="emprestimo.php" class="linkMenu"><li>Empréstimos</li></a>
				<a href="" class="linkMenu"><li>Devoluções</li></a>
				<a href="" class="linkMenu"><li>Pendências de Livros</li></a>
				<a href="" class="linkMenu"><li>Dados Gerais</li></a>
			</ul>
		</nav>

		<main class="conteudo">
			<div id="lista">
				<table class="lista">
					<tr>
						<th>ID</th>
						<th>Título</th>
						<th>Gênero</th>
						<th>Autor</th>
						<th>CDD</th>
						<th>ISBN</th>
						<th>Exemplares</th>
						<th>Data da Remessa</th>
					</tr>
					<?php
						include_once('Conexao.php');
						$sql = 'select livro.id, livro.titulo, livro. genero, autor.nome as autor, livro.cdd, livro.isbn, livro.exemplaes, livro.dataRemessa
								from livro join autor
								on livro.autor = autor.id';					
						$r = mysqli_query($con, $sql);
						if ($r) {
							while ($result = mysqli_fetch_array($r)) {
					?>
								<tr>
									<td><?php echo $result["id"]; ?></td>
									<td><?php echo $result["titulo"]; ?></td>
									<td><?php echo $result["genero"]; ?></td>
									<td><?php echo $result["autor"]; ?></td>
									<td><?php echo $result["cdd"]; ?></td>
									<td><?php echo $result["isbn"]; ?></td>
									<td><?php echo $result["exemplaes"]; ?></td>
									<td><?php echo $result["dataRemessa"]; ?></td>
								</tr>
					<?php
							}
						}
					?>
				</table>

				<table class="lista">
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Data de Nascimento</th>
						<th>Descrição</th>
					</tr>
					<?php
						include_once('Conexao.php');
						$sql = 'select * from autor';					
						$r = mysqli_query($con, $sql);
						if ($r) {
							while ($result = mysqli_fetch_array($r)) {
					?>
								<tr>
									<td><?php echo $result["id"]; ?></td>
									<td><?php echo $result["nome"]; ?></td>
									<td><?php echo $result["dataNasc"]; ?></td>
									<td><?php echo $result["descricao"]; ?></td>
								</tr>
					<?php
							}
						}
					?>
				</table>
			</div>
			
		</main>

		<footer class="rodape">
			jn
		</footer>
	</body>
</html>