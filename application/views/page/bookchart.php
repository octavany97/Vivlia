				<div id="chart1" class="panel panel-default">
					<div class="panel-heading" style="height: 50px;">
						<span style="margin-top: 15px;" ><i class="fa fa-bar-chart-o fa-fw"></i> Sales per Book Item | <?php echo $bookname; ?></span>
						<div class="pull-right">
							<select name="buku" class="form-control" id="buku">
								<?php
								
								foreach ($books as $book) {
									if($book['id_buku'] == $bookid){
										echo $bookid . " ". $book['id_buku'];		
										?>
										<option value="<?php echo $book['id_buku']; ?>" selected><?php echo $bookname; ?></option>
										<?php
									} else{
										?>
										<option value="<?php echo $book['id_buku']; ?>"><?php echo $book['nama_buku']; ?></option>
										<?php
									}
									?>
									
									<?php
								}
								?>
							</select>
						</div>
					</div>
					<!-- /.panel-heading -->
					<div id="bookchart" class="panel-body">
						<div id="piechart"></div>
					</div>
				</div>
<!-- piechart script -->
<script type="text/javascript">
$(document).ready(function() {
	$('#buku').change(function(){
		var idbuku = $('#buku').val();
		$('#buku > option selected').text(idbuku);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>adm/changeBookChart/",
			data: 'idbuku='+idbuku,
			success: function(classes){
				$('#chart1').empty().html(classes)				
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
			text: 'The Sale of ' + '"<?php echo $bookname; ?>"' + ' Book'
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
			],

		}]
	});
})
</script>