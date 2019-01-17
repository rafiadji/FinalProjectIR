<!DOCTYPE html>
<html>
<head>
	<title>TA Information Retrieval</title>
	<style type="text/css">
		.header {
			padding: 0 15px 15px 15px;
		}

		.body {
			padding: 15px;
		}

		table {
			border-collapse: collapse;
		}

		td, th {
			padding: 7px;
		}

		td {
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>TA Information Retrieval</h2>
		<a href="#">Dokumen</a> |
		<a href="#">Unique Word</a>
	</div>
	<div class="body">
		<div>
			<?php
				include("index.php");

				echo "<p>D1 : Heboh Pria di Jagakarsa Gantung Diri Sambil Live Facebook</p>";
				echo "<p>D2 : Jamaah Umroh asal Gresik Meninggal saat Tiba di Bandara Juanda</p>";
			?>
			<a href="index.php">Latih Data Baru</a>
		</div>

		<table border='1' style="margin-top: 20px">
			<thead>
				<tr>
					<th rowspan="2">Q</th>
					<th colspan="3">tf</th>
					<th rowspan="2">df</th>
					<th rowspan="2">idf</th>
					<th colspan="3">W = tf * IDF</th>
				</tr>
				<tr>
					<th>d1</th>
					<th>d2</th>
					<th>d3</th>
					<th>d1</th>
					<th>d2</th>
					<th>d3</th>
				</tr>
			</thead>
			<tbody>
				<?php
					include("koneksi.php");

					$sql = mysqli_query($con, "SELECT * FROM unique_word");
					if(mysqli_num_rows($sql) == 0) {
						echo "<tr><td colspan='10'>Data kosong</td></tr>";
					} else {
						$tfidf1 = 0;
						$tfidf2 = 0;
						$tfidf3 = 0;

						while($res = mysqli_fetch_assoc($sql)) {
							$sum_doc = []; // hitung seluruh nilai tfidf
							

							echo "
							<tr>
								<td>".$res['uword']."</td>
								<td>".tf($res['uword'],$all_doc[0])."</td>
								<td>".tf($res['uword'],$all_doc[1])."</td>
								<td>".tf($res['uword'],$all_doc[2])."</td>
								<td>".df($res['uword'],$all_doc)."</td>
								<td>".round(idf($res['uword'],$all_doc),4)."</td>
								<td>".round(tfidf($res['uword'],$all_doc[0],$all_doc),4)."</td>
								<td>".round(tfidf($res['uword'],$all_doc[1],$all_doc),4)."</td>
								<td>".round(tfidf($res['uword'],$all_doc[2],$all_doc),4)."</td>
							</tr>
							";

							$tfidf1 += round(tfidf($res['uword'],$all_doc[0],$all_doc),4);
							$tfidf2 += round(tfidf($res['uword'],$all_doc[1],$all_doc),4);
							$tfidf3 += round(tfidf($res['uword'],$all_doc[2],$all_doc),4);
						}
					}
				?>

				<tr>
					<td colspan="6"></td>
					<td><?php echo $tfidf1 ?></td>
					<td><?php echo $tfidf2 ?></td>
					<td><?php echo $tfidf3 ?></td>
				</tr>
			</tbody>
		</table>

		<div style="margin-top: 20px">
			Cosine Similarity :
		</div>
	</div>
</body>
</html>