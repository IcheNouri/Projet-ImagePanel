<?php
require_once("getImg.php");
require_once("functions.php");

if ($argv[1] && $argv[1][0] == "-"  && isset($argv[1][1])
	&& optionTest($argv[1]) && preg_match('/^-[gjlnNps]+$/i', $argv[1]) && preg_match('/^[\w]+$/', $argv[$argc - 1])){
	$i = 2;
	$j = 2;
	if (mb_substr_count($argv[1], "l") == 1){
		if ((int)($argv[2])){
			$i = 3;
			$j = 3;
		}
		else{
			echo "l'option -l a besoin d'un chiffre en 2eme argument.\n";
		exit;
		}
	}

	if(urlTest($argv[2]) || is_file($argv[2])){}
	else{
			echo $argv[$i]. " est introuvable.\n";
			exit;
	}


	$k = $i;
	while ($k < $argc - 1){
		if(urlTest($argv[$k]) || is_file($argv[$k])){
		$k++;
		}
		else{
			echo $argv[$i]. " est introuvable.\n";
			exit;
		}
	}

	$j = 0;
	while (isset($argv[$i])){
			$arg[$j] = $argv[$i];
			$j++;
			$i++;
		}

	if ($argc > $j + 1){
		if (mb_substr_count($argv[1], "l") == 1){
			if (mb_substr_count($argv[1], "g") == 1){
				getImg($arg, $j - 1, $argv[$argc - 1], "-g", $argv[2]);
			}
			else if (mb_substr_count($argv[1], "j") == 1){
				getImg($arg, $j - 1, $argv[$argc - 1], "-j", $argv[2]);
			}
			else if (mb_substr_count($argv[1], "n") == 1){
				getImg($arg, $j - 1, $argv[$argc - 1], "-n", $argv[2]);
			}
			else if (mb_substr_count($argv[1], "N") == 1){
				getImg($arg, $j - 1, $argv[$argc - 1], "-N", $argv[2]);
			}
			else if (mb_substr_count($argv[1], "p") == 1){
				getImg($arg, $j - 1, $argv[$argc - 1], "-p", $argv[2]);
			}
			else if (mb_substr_count($argv[1], "s") == 1){
				echo "non implementé\n";
			}
			else
				getImg($arg, $j - 1, $argv[$argc - 1], "-j", $argv[2]);
		}
		else if (mb_substr_count($argv[1], "g") == 1){
			getImg($arg, $j - 1, $argv[$argc - 1], "-g" );
		}
		else if (mb_substr_count($argv[1], "j") == 1){
			getImg($arg, $j - 1, $argv[$argc - 1], "-j");
		}
		else if (mb_substr_count($argv[1], "n") == 1){
			getImg($arg, $j - 1, $argv[$argc - 1], "-n");
		}
		else if (mb_substr_count($argv[1], "N") == 1){
			getImg($arg, $j - 1, $argv[$argc - 1], "-N");
		}
		else if (mb_substr_count($argv[1], "p") == 1){
			getImg($arg, $j - 1, $argv[$argc - 1], "-p");
		}
		else if (mb_substr_count($argv[1], "s") == 1){
			echo "non implementé\n";
		}
	}
	else
	echo "vous n'avez pas le bom nombre d'argument.\nphp imagepanel.php options(g l j n N p s) lien1 [lien2 [...]] base\n";
}
else
	echo "mauvais argument: php imagepanel.php options(g l j n N p s) lien1 [lien2 [...]] base (character alphanumeric)\n";