<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php echo $css; ?>
</head>
<body>
	<?php echo $header; ?>
	<?php echo $menuheader; ?>
	<?php echo $sidebar; ?>	
	</nav>
	
	<div class="col-md-10 pull-right">
		<h1>Latest Statistic</h1>
		<div class="col-md-5" id="piechart"></div>
		<div class="col-md-5">
			<form>
				
			</form>
		</div>
	</div>
	<div class="col-md-10 pull-right">
		<h3>Sales per Store</h3>
		<div class="col-md-5" id="piechart2"></div>
		<div class="col-md-5">
			<form>
				
			</form>
		</div>
	</div>
		
	
	
</body>
<?php echo $js; ?>
<!-- piechart script -->
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

	$('#piechart2').highcharts({
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: true
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
</html>