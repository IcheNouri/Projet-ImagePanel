<?php
function 	optionTest($param){
	if (mb_substr_count($param, "-") <= 2 && mb_substr_count($param, "g") <= 1 &&
		mb_substr_count($param, "j") <= 1 && mb_substr_count($param, "l") <= 1 &&
		mb_substr_count($param, "n") <= 1 && mb_substr_count($param, "N") <= 1 &&
		mb_substr_count($param, "p") <= 1 && mb_substr_count($param, "s") <= 1){
		return true;
	}
	else
		return false;
}

function urlTest($url){
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_NOBODY, true);
	$result = curl_exec($curl);
	if ($result !== false) 
	{
	  $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
	  if ($statusCode == 404) 
	  {
	    return false;
	  }
	  else
	  {
	     return true;
	  } 
	}
	else
	{
	  return false;
	}
}