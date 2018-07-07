<div id="chart2" class="panel panel-blue">
	<div class="panel-heading" style="height: 50px;">
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
	$('#stockchart').highcharts({
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
	        type: 'Genre'
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
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
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

// $(function(){
// 	$('#stackchart').highcharts ({
// 	    chart: {
// 	        type: 'column'
// 	    },
// 	    title: {
// 	        text: 'Stacked column chart'
// 	    },
// 	    xAxis: {
// 	        categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
// 	    },
// 	    yAxis: {
// 	        min: 0,
// 	        title: {
// 	            text: 'Total fruit consumption'
// 	        }
// 	    },
// 	    tooltip: {
// 	        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
// 	        shared: true
// 	    },
// 	    plotOptions: {
// 	        column: {
// 	            stacking: 'percent'
// 	        }
// 	    },
// 	    series: [{
// 	        name: 'John',
// 	        data: [5, 3, 4, 7, 2]
// 	    }, {
// 	        name: 'Jane',
// 	        data: [2, 2, 3, 2, 1]
// 	    }, {
// 	        name: 'Joe',
// 	        data: [3, 4, 4, 2, 5]
// 	    }]
// 	})
// })
</script>