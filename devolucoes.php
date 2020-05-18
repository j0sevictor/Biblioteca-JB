<?php
    include_once('autenticador.php');
    include_once('varcod.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BJB</title>
		<link rel="stylesheet" type="text/css" href="_css/estilo.css">
		<link rel="stylesheet" type="text/css" href="_css/emprestimo.css">
		<link rel="stylesheet" type="text/css" href="_css/listar.css">
		<link rel="shortcut icon" type="image/x-png" href="_imagens/logo.png">
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
		<script type="text/javascript" src="_javascript/pesquisa.js"></script>
	</head>

	<body>

		<header class="cabecalho">
			<div id="logo">
				<img src="_imagens/logo.png" width="100%">
			</div>

		</header>	

		<?php include_once('menu.html'); ?>

		<main class="conteudo">
			<div class="bloco">			
				<h1>Devolução para Alunos</h1>
				<table class="formulario">
					<tr>
						
						<td>Ano
							<select name="ano" id="ano" class="field">
								<?php
								$anos = ['1', '2', '3'];
									foreach ($anos as $ano){
										echo '<option value="' . $ano . '">' . $ano . '°' . '</option>';
									}
								?>
							</select></td>
					</tr>

					<tr>
						
						<td>Turma
							<select name="turma" id="turma" class="field">
								<?php
									foreach ($cursos as $curso){
										echo '<option value="' . $curso . '">' . $curso . '</option>';
									}
								?>	
							</select>
						</td>
					</tr>


					<tr>
						
						<td>Número<input type="number" name="numero" id="numero" class="field" value="{{old('numero')}}"></td>
					</tr>

					<tr>
						<th><input type="submit" id="btPesquisa" class="enter" value="Pesquisar dados"></th>
					</tr>
					
				</table>
			</div><!--
		
		--><div class="bloco">
				<div id="emprestimosaluno">
					
				
				</div>

				<script type="text/javascript">
					function abrirTelaDevolverAluno(id)
					{
						var nome = document.getElementById('nomeleitor').innerHTML;
						var titulo = document.getElementById('titulo' + id).innerHTML;

						var r = confirm('Você deseja Efetuar a Devolução de "' + titulo + '" para ' + nome);

						if (r){
							window.location.href = "devolver.php?id=" + id + '&tipo=ALUNO';	
						}
					}
				</script>
			</div>
			
			<div class="bloco">
				<div class="formulario">
		
					<h1>Devolução para Professores</h1>
					<table class="formulario">
						<tr>
							<?php
							
							
							?>
							<td>Nome<input type="text" name="nomeProf" id="nomeProf" class="field"></td>
						</tr>

						<tr>
							<th><input type="submit" id="btPesquisaProf" class="enter" value="Pesquisar dados"></th>
						</tr>
						
					</table>
				</div>		
			</div><!--
		
		--><div class="bloco">
				<div id="emprestimosprof"> 
								
				
				</div>

				<script type="text/javascript">
					function abrirTelaDevolverProf(id)
					{
						var nome = document.getElementById('nomeleitorP').innerHTML;
						var titulo = document.getElementById('tituloP' + id).innerHTML;

						var r = confirm('Você deseja Efetuar a Devolução de "' + titulo + '" para ' + nome);

						if (r){
							window.location.href = 'devolver.php?id=' + id + '&tipo=PROF';	
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