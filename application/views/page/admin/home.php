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
                <h1 class="page-header">Dashboard | <small style="font-size: 16pt;">Latest Statistic</small></h1>
            </div>	
            

		</div>
		<div class="row">
			<div class="col-lg-8">
				<?php echo $bookchart; ?>
			</div>
			<div class="col-lg-4">
				<?php echo $notifpanel; ?>
            </div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<?php echo $stockchart; ?>
			</div>
			<div class="col-lg-4">
				<?php echo $booksentpanel; ?>
            </div>
            <div class="col-lg-4">
				<?php echo $bestsellerbook; ?>
            </div>
		</div>
		<div class="row">
			<div class="col-lg-8">
				<?php echo $storechart; ?>
			</div>
		</div>
	</div>
</body>
</html>