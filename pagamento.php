<?php

function getbd() {
	$bd = pg_connect("host=localhost port=5432 dbname=postgres user=jpaulo password=8815") or die('connection failed');
	return $bd;
}

$matr = $_GET['matr'];
$curso = $_GET['curso'];

$rCurso = pg_exec(getbd(), "select * from curso where id=".$curso);
$curso = pg_fetch_array($rCurso);

echo '
	<fieldset>
		<legend><h3>Efetuar pagamento</h3></legend>
		<form action="efetuaPagamento.php" method="post">
			Curso: '.$curso["nome"].';<br>
			Valor: '.$curso["valor_inscricao"].';<br><br>
			<label for="valor"> Valor recebido: </label><br>
			<input id="valor" name="valor" type="number" value="000" required>, 
			<input id="valor_dec" name="valor_dec" type="number" min="0" max="99" value="00"><br>
			<input type="hidden" name="matr" value="'.$matr.'">
			<input type="hidden" name="curso" value="'.$curso["valor_inscricao"].'">
			<input type="submit">
		</form>
	</fieldset>
';

?>
