$(function(){
	$("#livroTitulo").keyup(function(){
		
		var pesquisa = $(this).val();
		
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa
			}		
			$.post('busca.php', dados, function(retorna){
				$(".resultado").html(retorna);
			});
		}		
	});
});

$(function(){
	$("#livroTitulo2").keyup(function(){
		
		var pesquisa = $(this).val();
		
		if(pesquisa != ''){
			var dados = {
				palavra : pesquisa
			}		
			$.post('busca.php', dados, function(retorna){
				$(".resultado2").html(retorna);
			});
		}		
	});
});

$(function(){
	$("#btPesquisa").click(function(){
		
		var ano = $('#ano').val();
		var turma = $('#turma').val();
		var num = $('#numero').val();
		var tip = 'ALUNO';
		
		var dados = {
			serie : ano,
			curso : turma,
			numero : num,
			tipo : tip
		}		
		$.post('buscarPendencias.php', dados, function(retorna){
			$("#emprestimosaluno").html(retorna);
		});
	
	});
});

$(function(){
	$("#btPesquisaProf").click(function(){

		var nom = $('#nomeProf').val();
		var tip = 'PROF';

		var dados = {
			nome : nom,
			tipo : tip
		}		
		$.post('buscarPendencias.php', dados, function(retorna){
			$("#emprestimosprof").html(retorna);
		});
	
	});
});
