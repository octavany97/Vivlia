<!DOCTYPE html>
<html id="home">
<head>
	<title></title>
	<?php echo $css; ?>
</head>
<body>
	<?php echo $header; ?>
	<?php echo $menuheader; ?>
	<?php echo $sidebar; ?>	
	</nav>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
                <h1 class="page-header">Dashboard | <span style="font-size: 16pt;">Latest Statistic</span></h1>
            </div>	
		</div>
		<div class="row">
			<div class="col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading" style="height: 50px;">
						<span style="margin-top: 15px;" ><i class="fa fa-bar-chart-o fa-fw"></i> Sales per Book Item</span>
						<div class="pull-right">
							<form method="post" accept-charset="utf-8" action="<?php echo base_url(); ?>adm/dashboard">
								<select name="buku" class="form-control" id="buku">
									<?php
									foreach ($books as $book) {
										if($book['id_buku'] == $bookid){
											?>
											<option value="<?php echo $book['id_buku']; ?> " selected><?php echo $book['nama_buku']; ?></option>
											<?php
										} else{
											?>
											<option value="<?php echo $book['id_buku']; ?> "><?php echo $book['nama_buku']; ?></option>
											<?php
										}
										?>
										
										<?php
									}
									?>
								</select>
							</form>
						</div>
					</div>
					<!-- /.panel-heading -->
					<div id="bookchart" class="panel-body">
						<div id="piechart"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i> Sales per Store
						<div class="pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" id="chooseStore">
									Actions
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<?php
									foreach ($stores as $store) {
										?>
										<li><a href="#"><?php echo $store['nama_toko']; ?></a></li>
										<?php
									}
									?>
								</ul>
							</div>
						</div>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div id="piechart2"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="col-md-10 pull-right">
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
	</div> -->
		
	
	
</body>
<?php echo $js; ?>
<!-- piechart script -->
<script type="text/javascript">
$(document).ready(function() {
	$('#buku').change(function(){
		var idbuku = $('#buku').val();
		console.log(idbuku)
		$('#home').hide();
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>adm/changeBookChart/",
			data: 'idbuku='+idbuku,
			success: function(classes){
				// $('#buku > option').html('<option value='+idbuku+' selected>Buku Besar 3</option>')
				// console.log(classes);
				// //$('#home').html(classes);

				$('#home').show();
				// $.each(classes, function(id, name){
				// 	var opt = $('<option />');
				// 	opt.val(id);
				// 	opt.text(name);
					
				// })
			},
			error: function(xhr, status){
				alert("Oops there is an error!")
			}
		})
	})
})
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
</html>