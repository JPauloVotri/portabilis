<?php

function getbd() {
	$bd = pg_connect("host=localhost port=5432 dbname=postgres user=jpaulo password=8815") or die('connection failed');
	return $bd;
}

$nome = $_POST['nome'];
$valor = (double)$_POST['valor']+$_POST['valor_dec']/100;
$periodo = $_POST['periodo'];

$result = pg_query(getbd(), "INSERT INTO curso (nome, valor_inscricao, periodo) VALUES ('".$nome."', ".$valor.", ".$periodo.")");

if (!$result) {
   $errormessage = pg_last_error();
   echo "<br><br>Error with query: " . $errormessage;
   exit();
}

echo "Curso Cadastrado com sucesso!<br><br><a href='cadCurso.html'>Voltar</a>";

pg_close(getbd());

?>
