<?php

function getbd() {
	$bd = pg_connect("host=localhost port=5432 dbname=postgres user=jpaulo password=8815") or die('connection failed');
	return $bd;
}

include('valida-cpf.php');

$nome = $_POST['nome'];
$fone = ($_POST['telefone'] == "") ? NULL : $_POST['telefone'];
$dia_nasc = $_POST['dia_nasc'];
$mes_nasc = $_POST['mes_nasc'];
$ano_nasc = $_POST['ano_nasc'];
$nasc = $ano_nasc."-".$mes_nasc."-".$dia_nasc;
$cpf = $_POST['cpf'];
$rg = (int)$_POST['rg'];

if ($ano_nasc%4 == 0 && ($ano_nasc%100 != 0 || $ano_nasc%400 == 0)){
	echo "<script>
		alert('Ano Bissexto!');
	</script>";
}

$cpf = preg_replace('/[^0-9]/is', '', $cpf);

if (!valida_cpf($cpf)){
	echo "CPF Inválido.<br><br>";
	pg_close(getbd());
	echo "<a href='cadAluno.html'>Voltar</a>";
	exit();
}

$result = pg_query(getbd(), "INSERT INTO aluno (nome, telefone, data_nascimento, cpf, rg) VALUES ('".$nome."', '".$fone."', '".$nasc."', ".$cpf.", '".$rg."')");

if (!$result) {
	$errormessage = pg_last_error();
	echo "<br><br>Error with query: " . $errormessage;
	pg_close(getbd());
	exit();
}

echo "Aluno Cadastrado com sucesso!<br><br><a href='cadAluno.html'>Voltar</a>";

pg_close(getbd());

?>
