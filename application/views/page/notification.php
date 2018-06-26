<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Vivlia</title>
	<?php echo $css; ?>
	<?php echo $js; ?>
</head>
<body>
	<?php echo $header; ?>
	<?php echo $menuheader; ?>
	<?php echo $sidebar; ?>
</nav>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
                <h1 class="page-header">Notitications</h1>
            </div>	
		</div>
		<div class="row">
			<div id="listNotif" class="col-lg-4" style="border: 1px solid #eee; min-height: 500px; border-radius: 5px;">
				<?php echo $listnotif; ?>
			</div>
			<div id="detailNotif" class="col-lg-8" style="border: 1px solid #eee; min-height: 500px; border-radius: 5px;">
				<?php echo $notifdetail; ?>
            </div>
		</div>
	</div>
</body>
</html>

<script>
	function showDetailAdmin(id){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>adm/changeNotifDetail/",
			data: 'id_notif='+id,
			success: function(classes){
				$('#detailNotif').empty().html(classes)				
			},
			error: function(xhr, status){
				alert("Oops there is an error!")
			}
		})
	}

	function showDetailManager(id){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>mgr/changeNotifDetail/",
			data: 'id_notif='+id,
			success: function(classes){
				$('#detailNotif').empty().html(classes)				
			},
			error: function(xhr, status){
				alert("Oops there is an error!")
			}
		})
	}

	function changeFlagAdmin(flag,id){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>adm/changeNotifFlag/",
			data: 'flag='+flag+'&id_notif='+id,
			success: function(classes){
				$('#listNotif').empty().html(classes)		
			},
			error: function(xhr, status){
				alert("Oops there is an error!")
			}
		})
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>adm/changeNotifDetail/",
			data: 'id_notif='+id,
			success: function(classes){
				$('#detailNotif').empty().html(classes)		
			},
			error: function(xhr, status){
				alert("Oops there is an error!")
			}
		})
	}

	function changeFlagManager(flag,id){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url() ?>mgr/changeNotifFlag/",
			data: 'flag='+flag+'&id_notif='+id,
			success: function(classes){
				$('#listNotif').empty().html(classes)		
			},
			error: function(xhr, status){
				alert("Oops there is an error!")
			}
		})
	}
</script>