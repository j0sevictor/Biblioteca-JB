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

			<div id="lista">

                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><img src="_interface/voltar.png" id="voltar" title="Voltar à página anterior"></a>
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
                                <th></th>
                                <th></th>
                            </tr>
                            
                            <?php
                                include_once('Conexao.php');

                                $coluna = $_POST['coluna'];
                                $txt = $_POST['txtBusca'];
                                $tabela = $_POST['tabela'];

                                $palavras_chave = explode(' ', $txt);

                                if (!empty($txt)){
                                    if ($coluna == 'autor') {
                                        $sql = "SELECT livro.capa, livro.contra, livro.id, livro.titulo, livro.cdd, livro.isbn, autor.nome AS autor, livro.dataRemessa, livro.exemplares, livro.genero 
                                                FROM $tabela JOIN autor
                                                ON livro.autor = autor.id AND nome LIKE '%$txt%'";
                                    }else{
                                        $sql = "SELECT * FROM $tabela WHERE $coluna LIKE '%$txt%'";
                                    }
                                    $r = mysqli_query($con, $sql);
                                } else if ($coluna == 'dataRemessa'){
                                    $sql = "SELECT * FROM $tabela WHERE $coluna IS NULL";
                                    $r = mysqli_query($con, $sql);
                                } else{
                                    $sql = "SELECT * FROM $tabela WHERE $coluna = ''";
                                    $r = mysqli_query($con, $sql);
                                }
                    
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
                                    window.location.href = "excluir.php?id=" + id;	
                                }
                            }
                        </script>
                <?php
                    }else if ($tabela == 'autor'){
                ?>
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
                                    $x = TRUE;
                                    while ($result = mysqli_fetch_array($r)) {
                                        if ($x){
                            ?>
                                            <tr>
                                                <td class="livro"><img class="livro" src="<?php if (!empty($result['foto'])){ echo '_imagens/' . $result["foto"]; }else{ echo '_interface/escritorOculto.png'; } ?>"></td>
                                                <td class="X"><?php echo $result["id"]; ?></td>
                                                <td class="X"><?php echo $result["nome"]; ?></td>
                                                <td class="X"><?php echo $result["descricao"]; ?></td>
                                                <td class="X"><?php echo $result["dataNasc"]; ?></td>
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
                                                <td class="Y"><?php echo $result["dataNasc"]; ?></td>
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
                                    window.location.href = "excluir.php?id=" + id;	
                                }
                            }
                        </script>
                    


                <?php
                    }
                ?>

				
			</div>

			
			
		</main>
	</body>
</html>