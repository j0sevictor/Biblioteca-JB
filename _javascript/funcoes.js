function abrirTelaExcluir(id, nome, tipo){
    if (tipo == 'LIVRO'){
        console.log(document.getElementById('pop-up').style.display = "block");
        console.log(document.getElementById('descricao').innerHTML = 'Você realmente deseja apagar os dados do Livro "' + nome + '"');
        console.log(document.getElementById('excluir').href = "excluir.php?id=" + id);
    }
}