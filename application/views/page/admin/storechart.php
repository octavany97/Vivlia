<div id="chart3" class="panel panel-blue">
	<div class="panel-heading">
		<span><i class="fa fa-bar-chart-o fa-fw"></i> Sales per Store Item | <?php echo $storename; ?></span>
		<div class="pull-right">
			<select name="toko" class="form-control" id="toko" >
				<?php
				
				foreach ($stores as $store) {
					if($store['id_toko'] == $storeid){
						echo $storeid . " ". $store['id_toko'];		
						?>
						<option value="<?php echo $store['id_toko']; ?>" selected><?php echo $storename; ?></option>
						<?php
					} else{
						?>
						<option value="<?php echo $store['id_toko']; ?>"><?php echo $store['nama_toko']; ?></option>
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
	<div id="storechart" class="panel-body">
		<div id="barchart"></div>
	</div>
</div>
<!-- piechart script -->
<script type="text/javascript">
$(document).ready(function() {
	$('#toko').change(function(){
		var idtoko = $('#toko').val();
		console.log(idtoko)
		$('#buku > option selected').text(idtoko);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>adm/changeStoreChart/",
			data: 'idtoko='+idtoko,
			success: function(classes){
				$('#chart3').empty().html(classes)				
			},
			error: function(xhr, status){
				alert("Oops there is an error!")
			}
		})
		
	})
	
})
// $(function () {
// 	$('#barchart').highcharts({
// 		chart: {
// 			plotBackgroundColor: null,
// 			plotBorderWidth: null,
// 			plotShadow: false
// 		},
// 		title: {
// 			text: 'Sales per Item'
// 		},
// 		tooltip: {
// 			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
// 		},
// 		plotOptions: {
// 			pie: {
// 				allowPointSelect: true,
// 				cursor: 'pointer',
// 				dataLabels: {
// 					enabled: true,
// 					format: '<b>{point.name}</b>: {point.percentage:.1f} %',
// 					style: {
// 						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
// 					}
// 				}
// 			}
// 		},
// 		series: [{
// 			type: 'pie',
// 			name: 'Persentase Penjualan di Toko',
// 			data: [
// 				<?php 
// 					// data yang diambil dari database
// 					if(count($barchart)>0)
// 					{
// 					   foreach ($barchart as $row) {
// 					   	echo "['" .$row['nama_buku'] . "'," . $row['total'] ."],\n";
// 					   }
// 					 }

// 				 ?> 
// 			]
// 		}]
// 	});
// })
$(function(){
	$('#barchart').highcharts({
		chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Book Delivered in ' + '"<?php echo $storename;?>"'
	    },
	    subtitle: {
	        text: 'in Month'
	    },
	    xAxis: {
	        categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Banana']
	    },
	    yAxis: {
	    	min: 0,
	        title: {
	            text: 'Total books delivered'
	        },
	        stackLabels:{
	        	enabled:true,
	        	style: {
	        		color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
	        	}
	        }
	    },
	    legend: {
	        align: 'right',
	        x: -30,
	        verticalAlign: 'top',
	        y: 40,
	        floating: true,
	        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
	        borderColor: '#CCC',
	        borderWidth: 1,
	        shadow: false
	    },
	    plotOptions: {
	    	column: {
	    		stacking: 'normal',
	    		dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
	    		}
	    	}
	    },

	    tooltip: {
	        headerFormat: '<b>{point.x}</b><br/>',
        	pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
	    },

	    "series": [
		        {
			        name: 'Dua Saudara',
			        data: [5, 3, 4, 7, 2],
			        drilldown: 'Browsers'
			    }, {
			        name: 'Tiga Saudara',
			        data: [2, 2, 3, 2, 1],
			        drilldown: 'Firefox'
			    }
	        //{

	      //       "name": "Browsers",
	      //       "colorByPoint": true,
	      //       "data": [
	      //       {
			    //     "name": "Dua Saudara",
			    //     "data": [5, 3, 4, 7, 2],
			    //     "drilldown":"Dua Saudara"
			    // }, {
			    //     "name": "Tiga Saudara",
			    //     "data": [2, 2, 3, 2, 1],
			    //     "drilldown": "Tiga Saudara"
			    // }
	                // {
	                //     "name": "Chrome",
	                //     "y": 62.74,
	                //     "drilldown": "Chrome"
	                // },
	                // {
	                //     "name": "Firefox",
	                //     "y": 10.57,
	                //     "drilldown": "Firefox"
	                // },
	                // {
	                //     "name": "Internet Explorer",
	                //     "y": 7.23,
	                //     "drilldown": "Internet Explorer"
	                // },
	                // {
	                //     "name": "Safari",
	                //     "y": 5.58,
	                //     "drilldown": "Safari"
	                // },
	                // {
	                //     "name": "Edge",
	                //     "y": 4.02,
	                //     "drilldown": "Edge"
	                // },
	                // {
	                //     "name": "Opera",
	                //     "y": 1.92,
	                //     "drilldown": "Opera"
	                // },
	                // {
	                //     "name": "Other",
	                //     "y": 7.62,
	                //     "drilldown": null
	                // }
	        //    ]
	      //  }
	    ],
	    "drilldown": {
	        "series": [
	            {
	                "name": "Chrome",
	                "id": "Chrome",
	                "data": [
	                    [
	                        "v65.0",
	                        0.1
	                    ],
	                    [
	                        "v64.0",
	                        1.3
	                    ],
	                    [
	                        "v63.0",
	                        53.02
	                    ],
	                    [
	                        "v62.0",
	                        1.4
	                    ],
	                    [
	                        "v61.0",
	                        0.88
	                    ],
	                    [
	                        "v60.0",
	                        0.56
	                    ],
	                    [
	                        "v59.0",
	                        0.45
	                    ],
	                    [
	                        "v58.0",
	                        0.49
	                    ],
	                    [
	                        "v57.0",
	                        0.32
	                    ],
	                    [
	                        "v56.0",
	                        0.29
	                    ],
	                    [
	                        "v55.0",
	                        0.79
	                    ],
	                    [
	                        "v54.0",
	                        0.18
	                    ],
	                    [
	                        "v51.0",
	                        0.13
	                    ],
	                    [
	                        "v49.0",
	                        2.16
	                    ],
	                    [
	                        "v48.0",
	                        0.13
	                    ],
	                    [
	                        "v47.0",
	                        0.11
	                    ],
	                    [
	                        "v43.0",
	                        0.17
	                    ],
	                    [
	                        "v29.0",
	                        0.26
	                    ]
	                ]
	            },
	            {
	                "name": "Firefox",
	                "id": "Firefox",
	                "data": [
	                    [
	                        "v58.0",
	                        1.02
	                    ],
	                    [
	                        "v57.0",
	                        7.36
	                    ],
	                    [
	                        "v56.0",
	                        0.35
	                    ],
	                    [
	                        "v55.0",
	                        0.11
	                    ],
	                    [
	                        "v54.0",
	                        0.1
	                    ],
	                    [
	                        "v52.0",
	                        0.95
	                    ],
	                    [
	                        "v51.0",
	                        0.15
	                    ],
	                    [
	                        "v50.0",
	                        0.1
	                    ],
	                    [
	                        "v48.0",
	                        0.31
	                    ],
	                    [
	                        "v47.0",
	                        0.12
	                    ]
	                ]
	            },
	            {
	                "name": "Internet Explorer",
	                "id": "Internet Explorer",
	                "data": [
	                    [
	                        "v11.0",
	                        6.2
	                    ],
	                    [
	                        "v10.0",
	                        0.29
	                    ],
	                    [
	                        "v9.0",
	                        0.27
	                    ],
	                    [
	                        "v8.0",
	                        0.47
	                    ]
	                ]
	            },
	            {
	                "name": "Safari",
	                "id": "Safari",
	                "data": [
	                    [
	                        "v11.0",
	                        3.39
	                    ],
	                    [
	                        "v10.1",
	                        0.96
	                    ],
	                    [
	                        "v10.0",
	                        0.36
	                    ],
	                    [
	                        "v9.1",
	                        0.54
	                    ],
	                    [
	                        "v9.0",
	                        0.13
	                    ],
	                    [
	                        "v5.1",
	                        0.2
	                    ]
	                ]
	            },
	            {
	                "name": "Edge",
	                "id": "Edge",
	                "data": [
	                    [
	                        "v16",
	                        2.6
	                    ],
	                    [
	                        "v15",
	                        0.92
	                    ],
	                    [
	                        "v14",
	                        0.4
	                    ],
	                    [
	                        "v13",
	                        0.1
	                    ]
	                ]
	            },
	            {
	                "name": "Opera",
	                "id": "Opera",
	                "data": [
	                    [
	                        "v50.0",
	                        0.96
	                    ],
	                    [
	                        "v49.0",
	                        0.82
	                    ],
	                    [
	                        "v12.1",
	                        0.14
	                    ]
	                ]
	            }
	        ]
	    }
	})
})
</script>