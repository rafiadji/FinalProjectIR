<?php
	$d = [
		"Roses are red violet is blue your face is red, my face is blue",
		"Roses are red violet is blue so that my love is only for you"
	];

	echo "TF(red, D1) : ".tf("face",$d[0])."<br>";
	echo "TF(red, D2) : ".tf("face",$d[1])."<br>";
	echo "DF(face, D) : ".df("face",$d)."<br>"; 
	echo "IDF(red, D) : ".idf("face",$d)."<br>"; 
	echo "TF.IDF(love, D) : ".tf_idf("face",$d[0],$d)."<br>";
	echo "TF.IDF(love, D) : ".tf_idf("face",$d[1],$d)."<br>";
	echo tf_idf($d);

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

	function df($word,$D){
		$jumlah = 0;
		// $word = stopword($words);
		for ($i=0; $i< count($D); $i++) { 
			 $find = substr_count($D[$i],$word);
			 if ($find > 0) {
			 	$jumlah++;
			 }
			 
		}
		return $jumlah;
	}

	function idf($word,$D){
		$count = count($D);
		$df = df($word,$D);
		$idf = log($count/$df);
		return $idf;
	}

	function idfPlus1($word,$D){
		$count = count($D);
		$df = df($word,$D);
		$idf = log($count/$df)+1;
		return $idf;
	}

	function tf_idf($word,$d,$D){
		$tf = tf($word,$d);
		$idf = idf($word,$D);
		return $tf * $idf;
	}
?>