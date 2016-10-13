<?php

function valida_cpf($cpf = false) {
	if (!function_exists('calc_digitos_posicoes')){
		function calc_digitos_posicoes($digitos, $posicoes = 10, $soma_digitos = 0){
			for ($i = 0; $i<strlen($digitos); $i++){
				$soma_digitos = $soma_digitos+($digitos[$i]*$posicoes);
				$posicoes--;
			}

			$soma_digitos = $soma_digitos % 11;

			if ($soma_digitos<2){
				$soma_digitos = 0;
			}else{
				$soma_digitos = 11-$soma_digitos;
			}

			$cpf = $digitos.$soma_digitos;
			
			return $cpf;
		}
	}
	
	if (!$cpf){
		return false;
	}

	if (strlen($cpf) != 11){
		return false;
	}	

	$digitos = substr($cpf, 0, 9);
	$novo_cpf = calc_digitos_posicoes($digitos);
	$novo_cpf = calc_digitos_posicoes($novo_cpf, 11);
	
	if ($novo_cpf === $cpf){
		return true;
	} else {
		return false;
	}
}
?>
