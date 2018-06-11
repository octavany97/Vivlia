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
                <h1 class="page-header">Dashboard | <span style="font-size: 16pt;">Latest Statistic</span></h1>
            </div>	
		</div>
		<div class="row">
			<div class="col-lg-8">
				<?php
					echo $bookchart;
				?>
				
			</div>
		</div>
	</div>
</body>
</html>