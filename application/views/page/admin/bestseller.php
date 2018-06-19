<div id="bestSellerPanel" class="panel panel-blue">
	<div class="panel-heading">
		<span><i class="fa fa-bar-chart-o fa-fw"></i> Five Best Seller Books</span>
	</div>
	<!-- /.panel-heading -->
	<div id="besSellerData" class="panel-body">
		<ul>
			<?php 
			foreach ($bestseller as $row) {
				?>
				<li><?php echo $row['nama_buku'] . " - " . $row['nama_toko'] . " (" . $row['total'] . " books)"; ?></li>
				<?php
			}
			?>
		</ul>
	</div>
</div>