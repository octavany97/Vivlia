<div id="stockManagerChart" class="panel panel-blue">
	<div class="panel-heading">
		<span><i class="fa fa-bar-chart-o fa-fw"></i> Stock of Books at <?php echo $storename["nama_toko"]; ?></span>
	</div>
	<!-- /.panel-heading -->
	<div id="stockchart" class="panel-body">
		<div id="stackchart"></div>
	</div>
</div>
<!-- piechart script -->
<script type="text/javascript">
$(function(){
	$('#stackchart').highcharts({
		chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Stock of Books at "<?php echo $storename["nama_toko"]; ?>"'
	    },
	    subtitle: {
	        text: 'by Genre'
	    },
	    xAxis: {
	        type: 'category'
	    },
	    yAxis: {
	        title: {
	            text: 'Total stock of books'
	        }

	    },
	    legend: {
	        enabled: false
	    },
	    plotOptions: {
	        series: {
	            borderWidth: 0,
	            dataLabels: {
	                enabled: true,
	                format: '{point.y:.0f}'
	            }
	        }
	    },

	    tooltip: {
	        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> remaining<br/>'
	    },

	    "series": [
	        {
	            "name": "Genres",
	            "colorByPoint": true,
	            "data": [
	            	<?php
	            	if(count($genres) > 0){
	            		foreach ($genres as $row) {
		            		echo '{"name":"'.$row['nama'].'",';
		            		echo '"y":'.$row['total'].',';
		            		echo '"drilldown":"'.$row['nama'].'"},'."\n";
		            	}
	            	}
		            	
	            	?>
	            ]
	        }
	    ],
	    "drilldown": {
	        "series": [
	        <?php
	        	$nrow = count($books);
	        	$idx = 0;
	        	if(count($genres)>0){
	        		foreach ($genres as $row) {
		        		echo '{"name":"'.$row['nama'].'",';
		        		echo '"id":"'.$row['nama'].'",';
		        		echo '"data":[';
		        		for($i = $idx;$i<=$nrow;$i++) {
		        			if($books[$i]['nama'] == $row['nama']){
		        				echo '["'.$books[$i]['nama_buku'].'",'.$books[$i]['stok'].'],'."\n";		
		        			}
		        			else{
		        				$idx++;
		        				break;
		        			}
		        		}
		        		
		        		echo ']},'."\n";
		        	}	
	        	}
	        	
	        ?>
	        ]
	    }
	})
})

</script>