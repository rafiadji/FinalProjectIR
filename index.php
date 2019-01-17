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
	
	// Baca tabel dokumen
	function readDokumen() {
		include("koneksi.php");
		$resDoc = [];

		$sql = mysqli_query($con, "SELECT * FROM document");
		while($res = mysqli_fetch_assoc($sql)) {
			array_push($resDoc, strtolower($res['document']));
		}

		return $resDoc;
	}

	// Insert Unique Word
	function insertUniqueWord($word) {
		include("koneksi.php");
		for($i=0; $i<count($word); $i++) {
			$res_word = $word[$i]['word'];
			if($res_word == "" || $res_word == " ") {} else {
				$detAvWord = mysqli_query($con, "SELECT * FROM unique_word WHERE uword='".$res_word."'");
				$detAvWord = mysqli_num_rows($detAvWord);
				if($detAvWord == 0) {
					mysqli_query($con, "INSERT INTO unique_word VALUES('','$res_word')");
				}
			}
		}
	}

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

	function countUniqueWords($wd) {
		$word = "";
		for($i=0; $i<count($wd); $i++) { 
			$word .= strtolower($wd[$i])." ";
		}

		$word = rtrim($word," ");
		$word = stopword($word);
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
	
	// simple training data
	include("koneksi.php");
	mysqli_query($con, "TRUNCATE unique_word");

	$d1 = "Heboh Pria di Jagakarsa Gantung Diri Sambil Live Facebook";
	$d2 = "Jamaah Umroh asal Gresik Meninggal saat Tiba di Bandara Juanda";

	$doc = readDokumen();
	$test = [$d1,$d2,$doc[49]];
	$all_doc = [];

	for($i=0; $i<count($test); $i++) { 
		array_push($all_doc, stopword($test[$i]));
	}

	$un = countUniqueWords($test);
	insertUniqueWord($un);
?>
