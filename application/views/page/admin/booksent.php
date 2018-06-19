<div id="bookSentPanel" class="panel panel-blue">
	<div class="panel-heading">
		<span><i class="fa fa-bar-chart-o fa-fw"></i> Five Most Book Delivered</span>
	</div>
	<!-- /.panel-heading -->
	<div id="bookDelivered" class="panel-body">
		<ul>
			<?php 
			foreach ($booksent as $row) {
				?>
				<li><?php echo $row['nama_buku'] . " (" . $row['total'] . " books)"; ?></li>
				<?php
			}
			?>
		</ul>
	</div>
</div>