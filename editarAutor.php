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
				<img src="_interface/logo.png">
			</div>
		</header>	

		<?php include_once('menu.html'); ?>

		<main class="conteudo">

			<div class="bloco">
				<a href="listarAutores.php"><img src="_interface/voltar.png" id="voltar" title="Voltar à página Listar Autor"></a>
				<h2>Dados Atuais</h2>
				<?php
					$id = $_GET['id'];

					include_once('Conexao.php');
                    $sql = "SELECT * FROM autor WHERE id = $id";
                    					
                    $r = mysqli_query($con, $sql);
                    
					$result = mysqli_fetch_array($r);
				?>
				<table class="visualizar">

					<caption>
						<span id="icone">
							<a href="excluir.php?tipo=FOTO&target=<?php if (!empty($result["foto"])){ echo '_imagens/' . $result['foto']; }else{ echo '0'; } ?>&id=<?php echo $id ?>"><img src="_interface/foto.png" class="icone" title="Deletar a foto do autor"></a>
						</span>
					</caption>

					<tr>
						<td class="foto" colspan="2"><img class="foto" src="<?php if (!empty($result['foto'])){ echo '_imagens/' . $result["foto"]; }else{ echo '_interface/escritorOculto.png'; } ?>"></td>
					</tr>

					<tr>
						<td class="Y">Nome:</td>
						<td class="X"><?php echo $result["nome"]; ?></td>
					</tr>

					<tr>
						<td class="Y">Descrição:</td>
						<td class="X"><?php echo $result["descricao"]; ?></td>
					</tr>

                    <tr>
						<td class="Y">Nascimento:</td>
						<td class="X"><?php if ($result['dataNasc']){ echo date("d/m/Y", strtotime($result["dataNasc"])); }?></td>
					</tr>

                    <tr>
						<td class="Y">Autor do mês:</td>
                        <td class="X"> 
                            <?php 
                                if ($result['autordomes']) {
                                    echo 'Sim';
                                }else{
                                    echo 'Não';
                                }
                            ?>
                        </td>
					</tr>
				</table>

				<table class="visualizar">
					<tr>
						<th colspan="2" class="titulo">Livros Cadastrados do autor</th>
					</tr>
				<?php
					$sql = "SELECT capa, id, titulo FROM livro WHERE autor = $id";
					$r = mysqli_query($con, $sql);

					while ($result2 = mysqli_fetch_array($r)){
				?>
						<tr>
							<td class="livro"><img class="livro" src="<?php if (!empty($result2["capa"])){ echo '_imagens/' . $result2['capa']; }else{ echo '_interface/livroOculto.png'; } ?>"></td>
							<td colspan="2" class="XL"><a class="emplink" href="editarLivro.php?id=<?php echo $result2['id']?>"><?php echo $result2["titulo"]; ?></a></td>
						</tr>
				<?php
					}
				?>	
				</table>
			</div><!--
		
		--><div class="bloco">
				<form action="edicao.php" enctype="multipart/form-data" method="POST">
					<h2>Edição de Dados</h2>
					<table class="formulario">
                        <tr>							
							<td>Nome<input type="text" name="nomeautor" id="nomeautor" class="field" value="<?php echo $result["nome"]; ?>" maxlength="100" required="true"></td>
						</tr>

						<tr>
							<td>Descrição<textarea id="desc" name="desc" class="field"><?php echo $result["descricao"]; ?></textarea></td>
						</tr>

						<tr>
							<td>Nascimento<input type="date" class="field" name="datanasc" id="datanasc" value="<?php echo $result["dataNasc"]; ?>"></td>
						</tr>
						
						<tr>
                            <?php 
                                if ($result['autordomes']){
                                    echo '<td><input type="checkbox" value="true" name="autordomes" checked>Autor do Mês</td>';
                                }else{
                                    echo '<td><input type="checkbox" value="true" name="autordomes">Autor do Mês</td>';
                                }
                            ?>    
							    
						</tr>


						<tr>
							<td><label class="file" for="fotoAutor">Atualizar Foto</label><input type="file" name="fotoAutor" id="fotoAutor" class="file" accept="image/png, image/jpeg, image/jpg"></td>
						</tr>

						<tr>
							<th><input type="submit" class="enter" value="Atualizar Autor(a)"></th>
						</tr>

					</table>
					<input type="hidden" name="formulario" value="AUTOR">
					<input type="hidden" name="id" value="<?php echo $result['id'] ?>">
				</form>
			</div>

		</main>

	</body>
</html>