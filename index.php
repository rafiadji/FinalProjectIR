<?php
	$d = [
		"Roses are red violet is blue your face is red, my face is blue",
		"Roses are red violet is blue so that my love is only for you"
	];

	echo "TF(red, D1) : ".tf("red",$d[0])."<br>";
	echo "TF(blue, D2) : ".tf("blue",$d[1])."<br>";

	function countword($d) {
		return str_word_count($d);
	}

	function stopword($word) {
		$symbol = [".",",","?","(",")"];

		// proses menghilangkan simbol
		for($i=0; $i<count($symbol); $i++) {
			$word = str_replace($symbol[$i], "", $word);
		}

		return $word;
	}

	function tf($word,$d) {
		$count = 0;
		$res_stw = stopword($d);
		$exp = explode(" ",strtolower($res_stw));
		for($i=0; $i<countword($d); $i++) {
			if($exp[$i] == $word) {
				$count++;
			}
		}

		return $count / countword($d);
	}

	function df($words,$d){
		$jumlah = 0;
		$word = stopword($words);
		for ($i=0; $i< count($d); $i++) { 
			 $find = substr_count($d[$i],$word);
			 if ($find > 0) {
			 	$jumlah++;
			 }
			 
		}
		return $jumlah;
	}
?>