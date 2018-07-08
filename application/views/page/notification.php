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
<body onload="<?php if($this->session->userdata('peran') == 1) { ?>load_unseen_notification_admin()<?php } 
	else if($this->session->userdata('peran') == 2){?> load_unseen_notification_toko2()<?php }
		else if($this->session->userdata('peran') == 3){?> load_unseen_notification_toko()<?php } ?>">
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
<?php echo $script; ?>