<?php
function 	getImg($argv, $argc ,$base, $option, $num = 0){
	$pattern  = '#<img[^>]+src="([^"]+)"[^>]*>#';
	$h = 0;
	$i = 0;
	$j = 0;
	$count = 0;

	$my_image[$j] = imagecreatetruecolor(800, 800);


	while($i < $argc){
		if ($lien = fopen($argv[$i], "r"))
		{
			while (!feof($lien)) 
				{
				   	 $contents .= fread($lien, 8192);
				}
			 if(preg_match_all($pattern, $contents, $matches))
			 {
			 	 while (isset($matches[1][$h])) {	 		
			 		if(preg_match('#^(http|https|ftp)#', $matches[1][$h])){
			 			if (!preg_match_all('#\/$#', $argv[$i]))
			 				$argv[$i] .= "/";
			 			$link[$h] = $matches[1][$h];
			 			$url = fopen($link[$h], "r");
			 		}
			 		else if (is_file($argv[$i])) {
			 			$link[$h] = $matches[1][$h];
			 			$url = fopen($link[$h], "r");
			 		}
			 		else{
			 			if (!preg_match_all('#\/$#', $argv[$i]))
			 				$argv[$i] .= "/";
			 			$link[$h] = $argv[$i] . $matches[1][$h];
			 			$url = fopen($link[$h], "r");
			 		}
			 		$count++;
			 		$h++;
			 	}
			 }
			 else
		     	echo 'erreur';
			
		}
	    else
			echo "impossible d'ouvrir le lien";
			 // else
		  //   	echo 'erreur';
				 $i++;
				 
	}
	$h = 0;
	$X = 0;
	$Y = 0;
	$num_img = 0;
 	while($link[$h])
		{
			$nom_img_without_extension = pathinfo($link[$h]);
			$nom_img_without_extension = $nom_img_without_extension['filename'];
			 if ($num_img >= $num && $num != 0){
					$num_img = 0;
					$j++;
					$X = 0;
					$Y = 0;
					$my_image[$j] = imagecreatetruecolor(800, 800);
				}
		
			if($count <= 4){
				$calc = $count;
				$value = $count;
			}
				
			else{
				$calc = $count / 4;
				$value = 4;
			}
				
			$extension = strrchr($matches[1][$h],'.');
			$extension=substr($extension,1);
			if($extension == 'png')
				$insert = imagecreatefrompng($link[$h]);
			if($extension == 'gif')
				$insert = imagecreatefromgif($link[$h]);
			if($extension == 'jpeg' || $extension == 'jpg')
				$insert = imagecreatefromjpeg($link[$h]);
			$largeur_source = imagesx($insert);
			$hauteur_source = imagesy($insert);
			$largeur_destination = imagesx($my_image[$j]);
			$hauteur_destination = imagesy($my_image[$j]);
			imagecopyresampled($my_image[$j], $insert, $X, $Y, 0, 0, $largeur_destination / $value, $hauteur_destination / $calc, $largeur_source, $hauteur_source);
			if ($option == "-N"){
				$white = imagecolorallocate($my_image[$j], 255, 255, 255);
				imagestring($my_image[$j], 5, $X, $Y, $nom_img_without_extension . '.' . $extension, $white);
				}
			else if ($option == "-n"){
				$white = imagecolorallocate($my_image[$j], 255, 255, 255);
				imagestring($my_image[$j], 5, $X, $Y, $nom_img_without_extension, $white);
			}
			$h++;
			$X += $largeur_destination / $value;
			if ($X  >= 800)
			{
				$X = 0;
				$Y += $hauteur_destination / $calc;
			}
			$num_img++;
			$check = $j;
		}
		$j = 0;
		
		while ($j < $check + 1){
			if ($option == "-g")
				imagegif($my_image[$j], './' . $base . $j . '.gif');
			else if ($option == "-j")
	 			imagejpeg($my_image[$j], './' . $base . $j .'.jpg');
			else if ($option == "-p")
				imagepng($my_image[$j], './' . $base . $j .'.png');
			else
				imagejpeg($my_image[$j], './' . $base . $j .'.jpg');
			imagedestroy($my_image[$j]);
			$j++;
	}
	    fclose($lien);
		echo $count . " images trouvees\n";
}