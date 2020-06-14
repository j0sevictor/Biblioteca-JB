<?php
    include_once('Conexao.php');

    $tipo = $_POST['tipo'];

    if ($tipo == 'ALUNO'){
        $ano = $_POST['serie'];
        $turma = $_POST['curso'];
        $num = $_POST['numero'];
        
        echo $turma;

        $sql = "SELECT nomeleitor, livroid, dataemp, id FROM emprestimoaluno WHERE ano = '$ano' AND turma = '$turma' AND numero = $num AND estado = 'Emprestado'";
        $r = mysqli_query($con, $sql);

        $x = TRUE;

        while ($result = mysqli_fetch_array($r)){
            if ($x) {
                echo '<h1>Pendências de Livros Para <span id="nomeleitor">"' . $result['nomeleitor'] . '"</span></h1>';
                $x = FALSE;            
            }
            $sql = 'SELECT titulo, capa FROM livro WHERE id = ' . $result['livroid'];
            $r2 = mysqli_query($con, $sql);

            if ($result2 = mysqli_fetch_array($r2)){    
?>
                <table class="lista">
                    <tr>
                        <td class="livro"><img src="_imagens/<?php echo $result2['capa']; ?>" class="livro"></td>
                        <td id="<?php echo 'titulo' . $result['id'] ?>"><?php echo $result2['titulo']; ?></td>
                    </tr>

                    <tr>
                        <td>Pego em: <?php echo $result['dataemp']; ?></td>
                        <th><input type="submit" id="<?php echo $result['id'] ?>" class="enter" value="Autorizar Devolução" onclick="abrirTelaDevolverAluno(id)"></th>
                    </tr>
                </table>
<?php
            }
        }
    }else if ($tipo == 'PROF'){
        
        $nome = $_POST['nome'];

        $sql = "SELECT nomeleitor, livroid, dataemp, id FROM emprestimoprof WHERE nomeleitor = '$nome' AND estado = 'Emprestado'";
        $r = mysqli_query($con, $sql);

        $x = true;

        while ($result = mysqli_fetch_array($r)){
            if ($x) {
                echo '<h1>Pendências de Livros Para <span id="nomeleitorP">"' . $result['nomeleitor'] . '"</span></h1>';
                $x = false;            
            }
            $sql = 'SELECT titulo, capa FROM livro WHERE id = ' . $result['livroid'];
            $r2 = mysqli_query($con, $sql);

            if ($result2 = mysqli_fetch_array($r2)){ 
?>
                <table class="lista">
                    <tr>
                        <td class="livro"><img src="_imagens/<?php echo $result2['capa']; ?>" class="livro"></td>
                        <td id="<?php echo 'tituloP' . $result['id'] ?>"><?php echo $result2['titulo']; ?></td>
                    </tr>

                    <tr>
                        <td>Pego em: <?php echo $result['dataemp']; ?></td>
                        <th><input type="submit" id="<?php echo $result['id'] ?>" class="enter" value="Autorizar Devolução" onclick="abrirTelaDevolverProf(id)"></th>
                    </tr>
                </table>
<?php
            }
        }
    }

?>
