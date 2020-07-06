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

				<h1>Autores</h1>

				<form action="pesquisar.php" method="POST">
					<select name="coluna" class="fieldPesq" required>
						<option selected disabled>Selecione em qual Campo será feita a busca</option>
						<?php
							include_once('Conexao.php');

							$sql = "SELECT COLUMN_NAME AS coluna FROM information_schema.columns WHERE table_name = 'autor'";
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
					<input type="hidden" name="tabela" value="autor">
				</form>

				<table class="lista">
					<tr>
						<th>Foto</th>
						<th>ID</th>
						<th>Nome</th>
						<th>Descrição</th>
						<th>Data de Nascimento</th>
						<th>Autor do Mês</th>
						<th></th>
						<th></th>	
					</tr>
					<?php
						include_once('Conexao.php');
                        
                        $sql = 'SELECT * FROM autor ORDER BY nome';					
                        
                        $r = mysqli_query($con, $sql);
                        
						if ($r) {
							$x = TRUE;
							while ($result = mysqli_fetch_array($r)) {
								if ($x){
					?>
									<tr>
										<td class="livro"><img class="livro" src="<?php if (!empty($result['foto'])){ echo '_imagens/' . $result["foto"]; }else{ echo '_interface/escritorOculto.png'; } ?>"></td>
										<td class="X"><?php echo $result["id"]; ?></td>
										<td class="X"><?php echo $result["nome"]; ?></td>
										<td class="X"><?php echo $result["descricao"]; ?></td>
										<td class="X"><?php if ($result['dataNasc']){ echo date("d/m/Y", strtotime($result["dataNasc"])); } ?></td>
										<td class="X"><?php 
												if ($result['autordomes']) {
													echo 'Sim';
												}else{
													echo 'Não';
												}
												
										?></td>
										<td class="X"><a href="editarAutor.php?id=<?php echo $result['id'] ?>"><button class="linkBt">Editar</button></a></td>
										<td class="X"><button class="linkBtEx" id="<?php echo $result["id"]; ?>" value="<?php echo $result["nome"]; ?>" onclick="abrirTelaExcluir(id)">Excluir</button></td>
									</tr>
					<?php
								}else{
					?>
									<tr>
										<td class="livro"><img class="livro" src="<?php if (!empty($result['foto'])){ echo '_imagens/' . $result["foto"]; }else{ echo '_interface/escritorOculto.png'; } ?>"></td>
										<td class="Y"><?php echo $result["id"]; ?></td>
										<td class="Y"><?php echo $result["nome"]; ?></td>
										<td class="Y"><?php echo $result["descricao"]; ?></td>
										<td class="Y"><?php if ($result['dataNasc']){ echo date("d/m/Y", strtotime($result["dataNasc"])); } ?></td>
										<td class="Y"><?php 
												if ($result['autordomes']) {
													echo 'Sim';
												}else{
													echo 'Não';
												}
												 
										?></td>
										<td class="Y"><a href="editarAutor.php?id=<?php echo $result['id'] ?>"><button class="linkBt">Editar</button></a></td>
										<td class="Y"><button class="linkBtEx" id="<?php echo $result["id"]; ?>" value="<?php echo $result["nome"]; ?>" onclick="abrirTelaExcluir(id)">Excluir</button></td>
									</tr>
					<?php

								}

								if ($x) {
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
						var nome = document.getElementById(id).value;

						var r = confirm('Você deseja excluir o Autor "' + nome + '"');

						if (r){
							window.location.href = 'excluir.php?id=' + id + '&tipo=AUTOR';	
						}
					}
				</script>
			</div>

			
			
		</main>

	</body>
</html>