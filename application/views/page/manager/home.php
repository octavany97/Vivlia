<!DOCTYPE html>
<html>
<head>
	<title>Vivlia</title>
	<?php echo $css; ?>
	<?php echo $js; ?>
</head>
<body onload="load_unseen_notification_toko2()">
	<?php echo $header; ?>
	<?php echo $menuheader; ?>
	<?php echo $sidebar; ?>
</nav>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
                <h1 class="page-header">Dashboard | <small style="font-size: 16pt;">Latest Releases</small></h1>
            </div>	
		</div>
		<div class="row">
			<div class="col-lg-8">
				<?php echo $timeline; ?>
			</div>
			
            <div class="col-lg-4">
            	<?php echo $bestsellerbooks; ?>
            </div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				 <?php echo $pendapatan; ?>
		</div>
		<div class="row">
			<div class="col-lg-8">
				 <?php echo $stockbooks; ?>
			</div>
		</div>
	</div>
</body>
</html>
<?php echo $script;?>
