<div id="chart1" class="panel panel-blue">
	<div class="panel-heading">
		<span><i class="fa fa-bar-chart-o fa-fw"></i>   Profit | <?php echo date('Y'); ?></span>
	</div>
	<!-- /.panel-heading -->
	<div id="profitchart" class="panel-body">
		<div id="linechart"></div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
	$('#linechart').highcharts({
    chart: {
        type: 'line'
    },
    title: {
        text: 'Profit'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
        title: {
            text: 'Rp'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [ {
        name: 'Profit',
        data: [
            <?php for($i = 1; $i<=$month; $i++){
                
                //bingung saya
            }
            ?>
        ]
    }]
});
})
</script>