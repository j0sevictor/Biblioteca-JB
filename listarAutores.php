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

				<h1>Autores</h1>

				<form action="pesquisar.php" method="POST">
					<select name="coluna" class="fieldPesq">
						<option>Selecione em qual Campo será feita a busca</option>
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
						<th>ID</th>
						<th>Nome</th>
						<th>Descrição</th>
						<th>Data de Nascimento</th>
						<th>Autor do Mês</th>	
					</tr>
					<?php
						include_once('Conexao.php');
                        
                        $sql = 'SELECT * FROM autor ORDER BY nome';					
                        
                        $r = mysqli_query($con, $sql);
                        
						if ($r) {
							while ($result = mysqli_fetch_array($r)) {
					?>
								<tr>
									<td><?php echo $result["id"]; ?></td>
									<td><?php echo $result["nome"]; ?></td>
									<td><?php echo $result["descricao"]; ?></td>
                                    <td><?php echo $result["dataNasc"]; ?></td>
                                    <td><?php 
                                            if ($result['autordomes']) {
                                                echo 'Sim';
                                            }else{
                                                echo 'Não';
                                            }
                                             
                                    ?></td>
									<td><a href="editarAutor.php?id=<?php echo $result['id'] ?>"><button class="linkBt">Editar</button></a></td>
									<td><button class="linkBtEx" id="<?php echo $result["id"]; ?>" value="<?php echo $result["nome"]; ?>" onclick="abrirTelaExcluir(id)">Excluir</button></td>
								</tr>
					<?php
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

		<footer class="rodape">
			jn
		</footer>
	</body>
</html>