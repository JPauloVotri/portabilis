<?php

function getbd() {
	$bd = pg_connect("host=localhost port=5432 dbname=postgres user=jpaulo password=8815") or die('connection failed');
	return $bd;
}

$valor = (int)$_POST['valor'];
$valor_dec = (int)$_POST['valor_dec'];
$valor_dec /= 100;
$valor += $valor_dec;
$matr = $_POST['matr'];
$valorCurso = (double)$_POST['curso'];

//$rCurso = pg_exec(getbd(), "select valor_inscricao from curso where id=".$curso);
$rMatr = pg_exec(getbd(), "select * from matricula where id=".$matr);
//$valorCurso = pg_fetch_result($rCurso, 0, 0);

if ($valorCurso > $valor){
	echo "Saldo insuficiente para efetuar o pagamento do curso. Ainda são necessarios R$ ".($valorCurso-$valor);
}else{
	$result = pg_query(getbd(), "UPDATE matricula SET pago=1 where id=".$matr);
	echo "Inscriçao paga com sucesso.<br>";
	
	if ($valorCurso < $valor){
		$troco = number_format($valor-$valorCurso, 2); 
		echo "<br>Troco: ".$troco."<br>".geraTroco($troco);
	}
}

function geraTroco($troco){
	
	$c = 0;
	$l = 0;
	$x = 0;
	$v = 0;
	$i = 0;
	$L = 0;
	$X = 0;
	$V = 0;
	$I = 0;
	
	while ($troco >= 100){
		$c++;
		$troco -= 100;
	}
	while ($troco >= 50){
		$l++;
		$troco -= 50;
	}
	while ($troco >= 10){
		$x++;
		$troco -= 10;
	}
	while ($troco >= 5){
		$v++;
		$troco -= 5;
	}
	while ($troco >= 1){
		$i++;
		$troco -= 1;
	}
	while ($troco >= 0.5){
		$L++;
		$troco -= 0.5;
	}
	while ($troco >= 0.1){
		$X++;
		$troco -= 0.1;
	}
	while ($troco >= 0.05){
		$V++;
		$troco -= 0.05;
	}
	while ($troco >= 0.01){
		$I++;
		$troco -= 0.01;
	}
	
	return $c." cédulas de R$ 100,00;<br>
		".$l." cédulas de R$ 50,00;<br>
		".$x." cédulas de R$ 10,00;<br>
		".$v." cédulas de R$ 5,00;<br>
		".$i." cédulas de R$ 1,00;<br>
		".$L." moedas de R$ 0,50;<br>
		".$X." moedas de R$ 0,10;<br>
		".$V." moedas de R$ 0,05;<br>
		".$I." moedas de R$ 0,01;<br>";
}

pg_close(getbd());

?>
