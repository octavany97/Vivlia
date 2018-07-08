<div id="profitChart" class="panel panel-blue">
	<div class="panel-heading">
		<span><i class="fa fa-bar-chart-o fa-fw"></i>   Profit | <small id="tahun"><?php echo $yearnow; ?></small></span>
        <div class="pull-right">
            <select name="year" class="form-control" id="year" style="max-width: 150px;">
                <?php
                
                foreach ($thn as $th) {
                    if($th['year'] == $yearnow){
                        
                        ?>
                        <option value="<?php echo $th['year']; ?>" selected><?php echo $th['year']; ?></option>
                        <?php
                    } else{
                        ?>
                        <option value="<?php echo $th['year']; ?>"><?php echo $th['year']; ?></option>
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
	<div id="profitchart" class="panel-body">
		<div id="linechart"></div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#year').change(function(){
        var year = $('#year').val();
        
        $.ajax({
            method: "POST",
            url: "<?php echo base_url(); ?>mgr/changeProfitChart/",
            data: 'tahun='+year,
            success: function(classes){
                $('#profitChart').empty().html(classes)              
            },
            error: function(xhr, status){
                alert("Oops there is an error!")
            }
        })
        
    })
})
    
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
            <?php
            $ctr = 0; 
            
            for($i = 1;$i<=12;$i++){
                if($ctr < count($bulan)){
                    if($bulan[$ctr]['month'] == $i AND $ctr < count($bulan)-1){
                    echo $bulan[$ctr]['pendapatan'].",";
                    $ctr++;
                    }
                    else{
                        echo '0,';
                    }    
                }
                else{
                    echo '0,';
                }
                
            }
            ?>
        ]
    }]
})
});

</script>