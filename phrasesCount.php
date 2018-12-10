<?php
$d1 = "pen pineapple apple pen";
$d2 = "I have a pen, i have an apple, apple pen";
$n = 3; // N-Gram

function phrasesCount($wordCount, $n) {
	// menghiraukan simbol koma dan titik
	$symbol = array(".",",");

	// proses menghilangkan simbol
	for($i=0; $i<count($symbol); $i++) {
		$word = str_replace($symbol[$i], "", $wordCount);
	}

	// memecah kata
	$exp = explode(" ", $word);

	// proses memilah frasa
	$phrasesRes = array();
	for($j=0; $j<count($exp)-($n-1); $j++) {
		$phrase = ""; 
		for($k=$j; $k<=$j+($n-1); $k++) {
			$phrase .= $exp[$k]." ";
		}

		$phrase = rtrim($phrase," ");
		array_push($phrasesRes, $phrase);
	}

	return $phrasesRes;
}

$pc = phrasesCount($d2,$n);
$cpc = count($pc);
?>