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

				<h1>Dodos de Empréstimo</h1>
                
                <table class="visualizar2">
                    <?php
                        include_once('Conexao.php');

                        $id = $_GET['id'];
                        $tipo = $_GET['tipo'];

                        if ($tipo) {
                            $form = 'ALUNO';
                            $sql = "SELECT aluno.nomeleitor, livro.titulo, aluno.id AS leitorid, emprestimo.estado, emprestimo.dataemp, emprestimo.datadev, livro.id AS livroid
                                    FROM emprestimo JOIN livro JOIN aluno
                                    ON emprestimo.livroid = livro.id AND emprestimo.leitorid = aluno.id AND emprestimo.id = $id";
                        }else{
                            $form = 'PROFESSOR';
                            $sql = "SELECT professor.nomeleitor, livro.titulo, professor.id AS leitorid, emprestimo.estado, emprestimo.dataemp, emprestimo.datadev, livro.id AS livroid
                                    FROM emprestimo JOIN livro JOIN professor
                                    ON emprestimo.livroid = livro.id AND emprestimo.leitorid = professor.id AND emprestimo.id = $id";
                        }
                        $r = mysqli_query($con, $sql);
                        $result = mysqli_fetch_array($r);
                    ?>
                    
                    <tr>   
                        <td class="Y">Leitor: </td>
                        <td class="XL"><a class="emplink" href="editarAP.php?id=<?php echo $result['leitorid']; ?>&tipo=<?php echo $form; ?>"><?php echo $result['nomeleitor']; ?></a></td>
                    </tr>

                    <tr>
                        <td class="Y">Permição: </td>
                        <td class="X"><?php echo $form; ?></td>
                    </tr>
                    
                    <tr>
                        <td class="Y">Título do Livro: </td>
                        <td class="XL"><a class="emplink" href="editarLivro.php?id=<?php echo $result['livroid']; ?>"><?php echo $result['titulo']; ?></a></td>
                    </tr>

                    <tr>
                        <td class="Y">Estado: </td>
                        <td class="X"><?php echo $result['estado']; ?></td>
                    </tr>

                    <tr>
                        <td class="Y">Data e hora do Emprestimo: </td>
                        <td class="X">
                            <?php
                                if ($result['dataemp']){
                                    $dataHora = explode(' ', $result['dataemp']);
                                    echo date("d/m/Y", strtotime($dataHora[0])) . ' - ' . substr($dataHora[1], 0, 5); 
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="Y">Data e hora da Devolução: </td>
                        <td class="X">
                            <?php
                                if ($result['datadev']){
                                    $dataHora = explode(' ', $result['datadev']);
                                    echo date("d/m/Y", strtotime($dataHora[0])) . ' - ' . substr($dataHora[1], 0, 5); 
                                }
                            ?>
                        </td>
                    </tr>
                    
                </table>
				
			</div><!--
		
         --><div class="bloco">
                <img src="_interface/excluir.png" id="exclu" title="Exluir Dados" onclick="abrirTelaExcluir()">         
                <?php if ($result['estado'] == 'Emprestado'){ ?>
                        <a id="emprestado" href="devolucoes.php?leitorid=<?php echo $result['leitorid']; ?>&tipo=<?php echo $form; ?>">Devolver</a>
                <?php } ?>

                <script type="text/javascript">
					function abrirTelaExcluir()
					{
						var r = confirm('Você realmente deseja excluir esses dados de empréstimo?');

						if (r){
							window.location.href = 'excluir.php?id=<?php echo $id; ?>&tipo=EMPRESTIMO';	
						}
					}
				</script>
            </div>

		</main>

	</body>
</html>