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
		<link rel="shortcut icon" type="image/x-png" href="_interface/logo.png">
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

				<h1>Livros</h1>

				
				<form action="pesquisar.php" method="POST">
					<select name="coluna" class="fieldPesq">
						<option>Selecione em qual Campo será feita a busca</option>
						<?php
							include_once('Conexao.php');

							$sql = "SELECT COLUMN_NAME AS coluna FROM information_schema.columns WHERE table_name = 'livro'";
							$r = mysqli_query($con, $sql);

							while ($result = mysqli_fetch_array($r)){
								if ($result['coluna'] != 'capa' && $result['coluna'] != 'contra') {
									echo '<option value"' . $result['coluna'] . '">' . $result['coluna'] . '</option>';
								}
							}
						?>
					</select>
					<div id="divBusca">
						<input type="text" id="txtBusca" name="txtBusca" placeholder="Buscar..."/>
						<input type="submit" id="btnBusca" value="Buscar">
					</div>	
					<input type="hidden" name="tabela" value="livro">
				</form>
				

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
						<th></th>
						<th></th>
					</tr>
					<?php
						include_once('Conexao.php');
						$sql = 'select livro.capa, livro.contra, livro.id, livro.titulo, livro.genero, autor.nome as autor, livro.cdd, livro.isbn, livro.exemplares, livro.dataRemessa
								from livro join autor
								on livro.autor = autor.id order by livro.titulo';					
						$r = mysqli_query($con, $sql);
						if ($r) {
							$x = TRUE;
							while ($result = mysqli_fetch_array($r)) {
								if ($x){
					?>
									<tr>
										<td class="livro"><img class="livro" src="<?php if (!empty($result["capa"])){ echo '_imagens/' . $result['capa']; }else{ echo '_interface/livroOculto.png'; } ?>"></td>
										<td class="livro"><img class="livro" src="<?php if (!empty($result["contra"])){ echo '_imagens/' . $result['contra']; }else{ echo '_interface/livroOculto.png'; } ?>"></td>
										<td class="X"><?php echo $result["id"]; ?></td>
										<td class="X"><?php echo $result["titulo"]; ?></td>
										<td class="X"><?php echo $result["genero"]; ?></td>
										<td class="X"><?php echo $result["autor"]; ?></td>
										<td class="X"><?php echo $result["cdd"]; ?></td>
										<td class="X"><?php echo $result["isbn"]; ?></td>
										<td class="X"><?php echo $result["exemplares"]; ?></td>
										<td class="X"><?php echo $result["dataRemessa"]; ?></td>
										<td class="X"><a href="editarLivro.php?id=<?php echo $result['id'] ?>"><button class="linkBt">Editar</button></a></td>
										<td class="X"><button class="linkBtEx" id="<?php echo $result["id"]; ?>" value="<?php echo $result["titulo"]; ?>" onclick="abrirTelaExcluir(id)">Excluir</button></td>
									</tr>
					<?php
								}else{
					?>
									<tr>
										<td class="livro"><img class="livro" src="<?php if (!empty($result["capa"])){ echo '_imagens/' . $result['capa']; }else{ echo '_interface/livroOculto.png'; } ?>"></td>
										<td class="livro"><img class="livro" src="<?php if (!empty($result["contra"])){ echo '_imagens/' . $result['contra']; }else{ echo '_interface/livroOculto.png'; } ?>"></td>
										<td class="Y"><?php echo $result["id"]; ?></td>
										<td class="Y"><?php echo $result["titulo"]; ?></td>
										<td class="Y"><?php echo $result["genero"]; ?></td>
										<td class="Y"><?php echo $result["autor"]; ?></td>
										<td class="Y"><?php echo $result["cdd"]; ?></td>
										<td class="Y"><?php echo $result["isbn"]; ?></td>
										<td class="Y"><?php echo $result["exemplares"]; ?></td>
										<td class="Y"><?php echo $result["dataRemessa"]; ?></td>
										<td class="Y"><a href="editarLivro.php?id=<?php echo $result['id']; ?>"><button class="linkBt">Editar</button></a></td>
										<td class="Y"><button class="linkBtEx" id="<?php echo $result["id"]; ?>" value="<?php echo $result["titulo"]; ?>" onclick="abrirTelaExcluir(id)">Excluir</button></td>
									</tr>
					<?php
								}
								if ($x){
									$x = FALSE;
								}else{
									$x = TRUE;
								}
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
							window.location.href = "excluir.php?id=" + id + '&tipo=LIVRO';	
						}
					}
				</script>
			</div>

			
			
		</main>

	</body>
</html>