<?php
$uw = array($d1,$d2);

function restrictSymbols($word) {
	$symbol = [".",",","?","(",")"];

	// proses menghilangkan simbol
	for($i=0; $i<count($symbol); $i++) {
		$word = str_replace($symbol[$i], "", $word);
	}

	return $word;
}

function countUniqueWords($wd) {
	$word = "";

	for($i=0; $i<count($wd); $i++) { 
		$word .= strtolower($wd[$i])." ";
	}

	$word = rtrim($word," ");
	$word = restrictSymbols($word);

	$exp = explode(" ", $word);

	$wordNew = [];
	$wordfinal = [];
	foreach ($exp as $row) {
		array_push($wordNew, $row);
	}

	$unique = array_unique($wordNew);
	foreach($unique as $count) {
		$found = array_keys($wordNew, $count);
		
		array_push($wordfinal, array("word" => $count, "count" => count($found)));
	}

	return $wordfinal;
}
?>