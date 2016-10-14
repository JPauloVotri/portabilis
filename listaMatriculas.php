<?php

function getbd() {
	$bd = pg_connect("host=localhost port=5432 dbname=postgres user=jpaulo password=8815") or die('connection failed');
	return $bd;
}

echo "<a href=\"index.html\">Voltar</a>";

$canc = $_GET['canc'];
$orderBy = $_GET['orderBy'];

if ($canc != NULL){
	cancelaMatricula($canc);
}

$result = pg_exec(getbd(), "select * from matricula where ativo=1".orderBy($orderBy));
$numrows = pg_numrows($result);

?>

<table border="1">
<tr>
	<th><a href="listaMatriculas.php?orderBy=id">ID da Matrícula</a></th>
	<th><a href="listaMatriculas.php?orderBy=aluno_id">Aluno (ID)</a></th>
	<th><a href="listaMatriculas.php?orderBy=curso_id">Curso (ID)</a></th>
	<th><a href="listaMatriculas.php?orderBy=data_matricula">Data da Matrícula</a></th>
	<th><a href="listaMatriculas.php?orderBy=ano">Ano</a></th>
	<th><a href="listaMatriculas.php?orderBy=pago">Pago?</a></th>
</tr>

<?php

for($i = 0; $i < $numrows; $i++) {
	echo "<tr>\n";
	$row = pg_fetch_array($result, $i);
	$rAluno = pg_exec(getbd(), "select * from aluno where id=".$row['aluno_id']);
	$rCurso = pg_exec(getbd(), "select * from curso where id=".$row['curso_id']);
	$aluno = pg_fetch_result($rAluno, 0, 'nome');
	$curso = pg_fetch_result($rCurso, 0, 'nome');
	echo "<td>", $row['id'], "</td>
		<td>".$aluno." (", $row['aluno_id'], ")</td>
		<td>".$curso." (", $row['curso_id'], ")</td>
		<td>", $row['data_matricula'], "</td>
		<td>", $row['ano'], "</td>
		<td>", ($row['pago'] == 1) ? 'Sim' : 'Não '.enviaPagamento($row['id'], $row['curso_id']), "</td>
		<td><a href='listaMatriculas.php?canc=".$row['id']."'>Desativar</a>
	</tr>";
}

function enviaPagamento($idMatr, $idCurso){

	return '<a href="pagamento.php?matr='.$idMatr.'&curso='.$idCurso.'">Pagar</a>';

}

function cancelaMatricula($id){
	
	$result = pg_query(getbd(), "UPDATE matricula SET ativo=0 where id=".$id);
	
}

function orderBy($orderBy){
	
	return ($orderBy != NULL) ? " ORDER BY ".$orderBy : $orderBy;
	
}

pg_close(getbd());

?>
