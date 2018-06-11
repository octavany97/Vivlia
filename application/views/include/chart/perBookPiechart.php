<?php echo $css; ?>
<div class="col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading" style="height: 50px;">
						<span style="margin-top: 15px;" ><i class="fa fa-bar-chart-o fa-fw"></i> Sales per Book Item</span>
						<div class="pull-right">
							<form method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>adm/dashboard">
								<select name="buku" class="form-control" onchange="this.form.submit()">
									<?php
									foreach ($books as $book) {
										?>
										<option value="<?php echo $book['id_buku']; ?>"><?php echo $book['nama_buku']; ?></option>
										<?php
									}
									?>
								</select>
							</form>
							<!-- <div class="btn-group">
								<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" id="chooseBook">
									Actions
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<?php
									foreach ($books as $book) {
										?>
										<li><a href="#"><?php echo $book['nama_buku']; ?></a></li>
										<?php
									}
									?>
								</ul>
							</div> -->
						</div>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div id="piechart"></div>
					</div>
				</div>
			</div>
<?php echo $js; ?>
			<script type="text/javascript">
 
$(function () {
	$('#piechart').highcharts({
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			text: 'Sales per Item'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %',
					style: {
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
					}
				}
			}
		},
		series: [{
			type: 'pie',
			name: 'Persentase Penjualan Buku',
			data: [
				<?php 
					// data yang diambil dari database
					if(count($piechart)>0)
					{
					   foreach ($piechart as $row) {
					   	echo "['" .$row['nama_toko'] . "'," . $row['total'] ."],\n";
					   }
					 }
				 ?> 
			]
		}]
	});
});
 
</script>