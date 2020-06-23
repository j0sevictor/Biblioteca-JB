<?php
    include_once('Conexao.php');

    $tipo = $_POST['tipo'];

    if ($tipo == 'ALUNO'){
        $ano = $_POST['serie'];
        $turma = $_POST['curso'];
        $num = $_POST['numero'];

        $sql = "SELECT aluno.nomeleitor, emprestimo.livroid, emprestimo.dataemp, emprestimo.id, livro.titulo, livro.capa
                FROM emprestimo JOIN aluno JOIN livro
                ON emprestimo.leitorid = aluno.id AND emprestimo.livroid = livro.id AND ano = '$ano' AND turma = '$turma' AND numero = $num AND estado = 'Emprestado' AND permicao = 'ALUNO'";
        $r = mysqli_query($con, $sql);

        $x =TRUE;

        while ($result = mysqli_fetch_array($r)){
            if ($x) {
                echo '<h1>Pendências de Livros Para <span id="nomeleitor">"' . $result['nomeleitor'] . '"</span></h1>';
                $x = FALSE;            
            }
?>
                <table class="lista2">
                    <tr>
                    <td class="livro"><img class="livro" src="<?php if (!empty($result["capa"])){ echo '_imagens/' . $result['capa']; }else{ echo '_interface/livroOculto.png'; } ?>"></td>
                        <td class="titulo" id="<?php echo 'titulo' . $result['id'] ?>"><?php echo $result['titulo']; ?></td>
                    </tr>

                    <tr>
                        <td>Pego em: <?php echo $result['dataemp']; ?></td>
                        <th><input type="submit" id="<?php echo $result['id'] ?>" class="enter" value="Autorizar Devolução" onclick="abrirTelaDevolverAluno(id)"></th>
                    </tr>
                </table>
<?php
        }
        if ($x) {
            echo "<h2>Nenhuma pendência foi achada para o número '$num' da turma '$turma'</h2>";
        }
    }else if ($tipo == 'PROF'){
        
        $nome = $_POST['nome'];

        $sql = "SELECT professor.nomeleitor, emprestimo.livroid, emprestimo.dataemp, emprestimo.id, livro.titulo, livro.capa
                FROM emprestimo JOIN professor JOIN livro
                ON emprestimo.leitorid = professor.id AND emprestimo.livroid = livro.id AND nomeleitor = '$nome' AND estado = 'Emprestado' AND permicao = 'PROFESSOR'";
        $r = mysqli_query($con, $sql);

        $x = TRUE;

        while ($result = mysqli_fetch_array($r)){
            if ($x) {
                echo '<h1>Pendências de Livros Para <span id="nomeleitorP">"' . $result['nomeleitor'] . '"</span></h1>';
                $x = FALSE;           
            }

?>
                <table class="lista2">
                    <tr>
                        <td class="livro"><img class="livro" src="<?php if (!empty($result["capa"])){ echo '_imagens/' . $result['capa']; }else{ echo '_interface/livroOculto.png'; } ?>"></td>
                        <td class="titulo" id="<?php echo 'tituloP' . $result['id'] ?>"><?php echo $result['titulo']; ?></td>
                    </tr>

                    <tr>
                        <td>Pego em: <?php echo $result['dataemp']; ?></td>
                        <th><input type="submit" id="<?php echo $result['id'] ?>" class="enter" value="Autorizar Devolução" onclick="abrirTelaDevolverProf(id)"></th>
                    </tr>
                </table>
<?php
        }
        if ($x) {
            echo "<h2>Nenhuma pendência foi achada para '$nome'</h2>";
        }
    }

?>