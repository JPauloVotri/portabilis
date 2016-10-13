<?php

function getbd() {
	$bd = pg_connect("host=localhost port=5432 dbname=postgres user=jpaulo password=8815") or die('connection failed');
	return $bd;
}

$aluno_id = $_POST['aluno_id'];
$curso_id = $_POST['curso_id'];
$dia_matr = $_POST['dia_matr'];
$mes_matr = $_POST['mes_matr'];
$ano_matr = $_POST['ano_matr'];
$data_matr = $ano_matr."-".$mes_matr."-".$dia_matr;
$ano = $_POST['ano'];
$pago = $_POST['pago'];

$rCurso = pg_exec(getbd(), "select * from curso where id=".$curso_id);
$valor = pg_fetch_result($rCurso, 0, 'valor_inscricao');

$pago = ($valor == 0) ? 1 : $pago;

if (!validaMatricula($aluno_id, $curso_id, $ano)){
	pg_close(getbd());
	exit();
}

$result = pg_query("INSERT INTO matricula (aluno_id, curso_id, data_matricula, ano, pago) VALUES ('".$aluno_id."', '".$curso_id."', '".$data_matr."', ".$ano.", '".$pago."')");

if (!$result) {
	$errormessage = pg_last_error();
	echo "<br><br>Error with query: " . $errormessage;
	pg_close(getbd());
	exit();
}

echo "Matricula Cadastrada com sucesso!<br><br><a href='cadMatricula.html'>Voltar</a>";

function validaMatricula($aluno, $curso, $ano){

	$rAluno = pg_exec(getbd(), "select * from matricula where aluno_id=".$aluno);
	$numrows = pg_numrows($rAluno);
	
	if ($numrows > 0){
		for ($i = 0; $i < $numrows; $i++){
			$row = pg_fetch_array($rAluno, $i);
			
			if ($row['ano'] == $ano && $row['ativo'] == 1){
				if ($row['curso_id'] == $curso){
					echo "Aluno já matriculado neste curso para o ano de $ano";
					return false;
				}else{
					$rPeriodoCurso[0] = pg_exec(getbd(), "select * from curso where id=".$curso);
					$rPeriodoCurso[0] = pg_fetch_result($rPeriodoCurso[0], 0, 'periodo');
					$rPeriodoCurso[1] = pg_exec(getbd(), "select * from curso where id=".$row['curso_id']);
					$rPeriodoCurso[1] = pg_fetch_result($rPeriodoCurso[1], 0, 'periodo');
					if ($rPeriodoCurso[0] == 3 || $rPeriodoCurso[1] == 3 || $rPeriodoCurso[0] == $rPeriodoCurso[1]){
						echo "Aluno já matriculado para esse período no ano de $ano.";
						return false;
					}
				}
			}
		}
	}
	return true;
}

pg_close(getbd());

?>
