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

                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><img src="_imagens/voltar.png" id="voltar"></a>
                <h1 id="titulo">Achado na Pesquisa:</h1>

                <?php
                    $tabela = $_POST['tabela'];
                    if ($tabela == 'livro'){
                ?>
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

                                $coluna = $_POST['coluna'];
                                $txt = $_POST['txtBusca'];
                                $tabela = $_POST['tabela'];

                                if (!empty($txt)){
                                    try {
                                        $sql = "SELECT * FROM $tabela WHERE $coluna LIKE '%$txt%'";
                                        $r = mysqli_query($con, $sql);
                                    } catch (Exeptimon $e) {
                                        $sql = "SELECT * FROM livro WHERE $coluna = $txt";
                                        $r = mysqli_query($con, $sql);
                                    }
                                } else if ($coluna == 'dataRemessa'){
                                    $sql = "SELECT * FROM $tabela WHERE $coluna IS NULL";
                                    $r = mysqli_query($con, $sql);
                                } else{
                                    $sql = "SELECT * FROM $tabela WHERE $coluna = ''";
                                    $r = mysqli_query($con, $sql);
                                }
                    
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
                <?php
                    }else if ($tabela == 'autor'){
                ?>
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

                                $coluna = $_POST['coluna'];
                                $txt = strtolower($_POST['txtBusca']);
                                
                                if  (!empty($txt)){
                                    if ($coluna == 'autordomes'){
                                        if ($txt == 'sim' || $txt == '0' || $txt == 's'){
                                            $txt = 1;
                                        }else {
                                            $txt = 0;
                                        }
                                    }
                
                                    try {
                                        $sql = "SELECT * FROM $tabela WHERE $coluna LIKE '%$txt%'";
                                        $r = mysqli_query($con, $sql);
                                    } catch (Exeptimon $e) {
                                        $sql = "SELECT * FROM $tabela WHERE $coluna = $txt";
                                        $r = mysqli_query($con, $sql);
                                    }
                                } else if ($coluna == 'dataNasc'){
                                    $sql = "SELECT * FROM $tabela WHERE $coluna IS NULL";
                                    $r = mysqli_query($con, $sql);
                                }else{
                                    $sql = "SELECT * FROM $tabela WHERE $coluna = ''";
                                    $r = mysqli_query($con, $sql);
                                }
                                
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
                                    window.location.href = "excluir.php?id=" + id;	
                                }
                            }
                        </script>
                    


                <?php
                    }
                ?>

				
			</div>

			
			
		</main>

		<footer class="rodape">
			jn
		</footer>
	</body>
</html>