<div class="col-sm-3">
	<div class="left-sidebar">
		<div class="brands_products"><!--brands_products-->
			<h2>Kategori</h2>
			<div class="brands-name">
				<ul class="nav nav-pills nav-stacked">
					<?php
						$query_kategori = "SELECT * FROM kategori";
						if ($result_kategori = $conn->query($query_kategori)) {
							while ($kategori = $result_kategori->fetch_assoc()) {
								$query_banyak = 'SELECT count(*) as banyak FROM barang WHERE kategori_barang='.$kategori["kode_kategori"].'';
								$result_banyak = $conn->query($query_banyak);
								$banyak = $result_banyak->fetch_assoc();
								echo '
								<li><a href="katalog.php?kodekategori='.$kategori["kode_kategori"].'"> <span class="pull-right">('.$banyak["banyak"].')</span>'.$kategori["nama_kategori"].'</a></li>';
							}
						}
						?>
				</ul>
			</div>
		</div><!--/brands_products-->
	</div>
</div>
