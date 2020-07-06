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
			
            <div class="bloco">
                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><img src="_interface/voltar.png" id="voltar" title="Voltar à página anterior"></a>

				<form action="edicao.php" method="POST">
					<h1>Editar dados de <?php if ($_GET['tipo']){ echo 'Aluno'; }else{ echo 'Professor'; } ?></h1>
					<table class="formulario">
                        <?php
                            include_once('Conexao.php');

                            $id = $_GET['id'];
                            $tipo = $_GET['tipo'];

                            if ($tipo) {
                                $form = 'ALUNO';
                                $sql = "SELECT nomeleitor, ano, turma, numero FROM aluno WHERE id = $id";
                                $r = mysqli_query($con, $sql);
                                $result = mysqli_fetch_array($r);
                        ?>
    
                                <tr>
                                    <td>Nome<input type="text" name="nome" id="nome" class="field" value="<?php echo $result['nomeleitor']; ?>" maxlength="85"></td>
                                </tr>

                                <tr>
                                    <td>Ano
                                        <select name="ano" id="ano" class="field" required>
                                            <?php
                                                $anos = ['1', '2', '3'];
                                                foreach ($anos as $ano){
                                                    if ($ano == $result['ano']) {
                                                        echo '<option value="' . $ano . '" selected>' . $ano . '°' . '</option>';
                                                    }else{
                                                        echo '<option value="' . $ano . '">' . $ano . '°' . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select></td>
                                </tr>

                                <tr>
                                    
                                    <td>Turma
                                        <select name="turma" id="turma" class="field" required>
                                            <?php
                                                for ($i = 0; $i <= 3; $i++){
                                                    if ($result['turma'] == $valores[$i]){
                                                        echo '<option value="' . $valores[$i] . '" selected>' . $cursos[$i] . '</option>';
                                                    }else{
                                                        echo '<option value="' . $valores[$i] . '">' . $cursos[$i] . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    
                                    <td>Número<input type="number" name="numero" id="numero" class="field" value="<?php echo $result['numero']; ?>" min="1" max="50" required="true"></td>
                                </tr>
                        <?php
                            }else{
                                $form = 'PROFESSOR';
                                $sql = "SELECT nomeleitor FROM professor WHERE id = $id";
                                $r = mysqli_query($con, $sql);
                                $result = mysqli_fetch_array($r);
                        ?>
            					<tr>
							        <td>Nome<input type="text" name="nome" id="nome" class="field" value="<?php echo $result['nomeleitor']; ?>" maxlength="85" required="true"></td>
			    			    </tr>
                        <?php
                        
                            }
                        ?>

						<tr>
							<th><input type="submit" class="enter" value="Atualizar"></th>
						</tr>

                        <input type="hidden" name="formulario" value="<?php echo $form; ?>">
					    <input type="hidden" name="id" value="<?php echo $id; ?>">
						
					</table>
				</form>
				
			</div><!--
		
         --><div class="bloco">
                <img src="_interface/excluir.png" id="exclu" title="Exluir Dados" onclick="abrirTelaExcluir()">                
                
                <script type="text/javascript">
					function abrirTelaExcluir()
					{
						var r = confirm('Excluir esse <?php echo $form; ?> apagará também os emprestimos registrados nesse nome.');

						if (r){
							window.location.href = 'excluir.php?id=<?php echo $id; ?>&tipo=<?php echo $form; ?>';	
						}
					}
				</script>

                <table class="visualizar">

					<tr>
						<td class="Y">Nome:</td>
						<td class="X"><?php echo $result["nomeleitor"]; ?></td>
					</tr>
                    <?php if ($tipo){ ?>
                            <tr>
                                <td class="Y">Ano:</td>
                                <td class="X"><?php echo $result["ano"]; ?></td>
                            </tr>

                            <tr>
                                <td class="Y">Turma:</td>
                                <td class="X">
                                    <?php
                                        for ($i = 0; $i <= 3; $i++){
                                            if ($result['turma'] == $valores[$i]) {
                                                echo $cursos[$i];
                                                break;
                                            }
                                        }  
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td class="Y">Numero:</td>
                                <td class="X"><?php echo $result['numero']; ?></td>
                            </tr>
                    <?php } ?>

                    <tr>
                        <?php
                            $sql = "SELECT COUNT(*) AS atual FROM emprestimo WHERE leitorid = $id AND permicao = '$form' AND estado = 'Emprestado'";
                            $result = mysqli_fetch_array(mysqli_query($con, $sql));
                        ?>
                        <td class="Y">Leituras em andamento:</td>
                        <td class="X"><?php echo $result['atual']; ?></td>
                    </tr>

                    <tr>
                        <?php
                            $sql = "SELECT COUNT(*) AS historico FROM emprestimo WHERE leitorid = $id AND permicao = '$form' AND estado = 'Entregue'";
                            $result = mysqli_fetch_array(mysqli_query($con, $sql));
                        ?>
                        <td class="Y">Livros Lidos:</td>
                        <td class="X"><?php echo $result['historico']; ?></td>
                    </tr>

                    <tr>
                        <?php
                            $mes = Date('m');
             
                            if ($mes <= 6 && $mes != 2){
                                $mes -= 2; 
                            }elseif ($mes >= 8){
                                $mes -= 3;
                            }
                            $media = $result['historico'] / $mes;
                        ?>
                        <td class="Y">Leitura Mensal:</td>
                        <td class="X"><?php echo $media; ?></td>
                    </tr>
				</table>
            </div>

		</main>

	</body>
</html>