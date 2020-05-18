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
        <link rel="stylesheet" type="text/css" href="_css/editar.css">
		<link rel="shortcut icon" type="image/x-png" href="_imagens/logo.png">
	</head>

	<body>

		<header class="cabecalho">
			<div id="logo">
				<img src="_imagens/logo.png">
			</div>
		</header>	

		<?php include_once('menu.html'); ?>

		<main class="conteudo">

			<div id="a" class="formulario">
				<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><img src="_imagens/voltar.png" id="voltar"></a>
				<h2>Dados Atuais</h2>
				<?php
					$id = $_GET['id'];

					include_once('Conexao.php');
                    $sql = "SELECT * FROM autor WHERE id = $id";
                    					
                    $r = mysqli_query($con, $sql);
                    
					$result = mysqli_fetch_array($r);
				?>
				<table class="visualizar">
					<tr>
						<td class="livro"><img class="livro" src="_imagens/<?php echo $result["nome"] ?>"></td>
					</tr>

					<tr>
						<td><?php echo $result["nome"]; ?></td>
					</tr>

					<tr>
						<td><?php echo $result["descricao"]; ?></td>
					</tr>
                    <tr>
						<td><?php echo $result["dataNasc"]; ?></td>
					</tr>
                    <tr>
                        <td>
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
			</div>

			<div id="b">
			<form action="edicao.php" enctype="multipart/form-data" method="POST">
					<h2>Edição de Dados</h2>
					<table class="formulario">
                        <tr>							
							<td>Nome<input type="text" name="nomeautor" id="nomeautor" class="field" value="<?php echo $result["nome"]; ?>"></td>
						</tr>

						<tr>
							<td><i>Descrição</i><textarea id="desc" name="desc" class="field"><?php echo $result["descricao"]; ?></textarea></td>
						</tr>

						<tr>
							<td><i>Nascimento</i><input type="date" class="field" name="datanasc" id="datanasc" value="<?php echo $result["dataNasc"]; ?>"></td>
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
							<td><label class="file" for="capa">Atualizar Foto</label><input type="file" name="capa" id="capa" class="file"></td>
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