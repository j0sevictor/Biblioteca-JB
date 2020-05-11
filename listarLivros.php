<?php
	include_once('autenticador.php');
?>
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

		</header>	

		<?php include_once('menu.html'); ?>

		<main class="conteudo">
			<div id="lista">

				<h1>Livros</h1>

				<div id="divBusca">
					<input type="text" id="txtBusca" placeholder="Buscar..."/>
					<button id="btnBusca">Buscar</button>
				</div>

				<table class="lista">
					<tr>
						<th>Capa</th>
						<th>Contracapa</th>
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
						$sql = 'select livro.capa, livro.contra, livro.id, livro.titulo, livro.genero, autor.nome as autor, livro.cdd, livro.isbn, livro.exemplares, livro.dataRemessa
								from livro join autor
								on livro.autor = autor.id order by livro.titulo';					
						$r = mysqli_query($con, $sql);
						if ($r) {
							while ($result = mysqli_fetch_array($r)) {
					?>
								<tr>
									<td class="livro"><img class="livro" src="_imagens/<?php echo $result["capa"] ?>"></td>
									<td class="livro"><img class="livro" src="_imagens/<?php echo $result["contra"] ?>"></td>
									<td><?php echo $result["id"]; ?></td>
									<td><?php echo $result["titulo"]; ?></td>
									<td><?php echo $result["genero"]; ?></td>
									<td><?php echo $result["autor"]; ?></td>
									<td><?php echo $result["cdd"]; ?></td>
									<td><?php echo $result["isbn"]; ?></td>
									<td><?php echo $result["exemplares"]; ?></td>
									<td><?php echo $result["dataRemessa"]; ?></td>
									<td><a href="editarLivro.php?id=<?php echo $result['id'] ?>"><button class="linkBt">Editar</button></a></td>
									<td><button class="linkBtEx" id="<?php echo $result["id"]; ?>" value="<?php echo $result["titulo"]; ?>" onclick="abrirTelaExcluir(id)">Excluir</button></td>
								</tr>
					<?php
							}
						}
					?>
				</table>

				<script type="text/javascript">
					function abrirTelaExcluir(id)
					{
						var titulo = document.getElementById(id).value;

						var r = confirm('Você deseja excluir o Livro "' + titulo + '"');

						if (r){
							window.location.href = "excluir.php?id=" + id;	
						}
					}
				</script>
			</div>

			
			
		</main>

		<footer class="rodape">
			jn
		</footer>
	</body>
</html>