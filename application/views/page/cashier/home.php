<!DOCTYPE html>
<html>
<head>
	<title>Vivlia</title>
	<?php echo $css; ?>
	<?php echo $js; ?>
</head>
<body>
	<?php echo $header;
	echo $menuheader;
	echo $sidebar;
	?>
	</nav>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
                <h1 class="page-header">Input Item</h1>
            </div>
		</div>
		<button name="confirm" id="confirm" class="btn btn-success" onclick="showModalConfirm()">Confirm</button>			
	</div>
	<div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	    <div class="modal-dialog">
	      <div class="loginmodal-container" style="min-width: 900px; position: relative; left: -25%;">
	          <h1>Please Check The Purchase Again</h1><br>
	          <form method="POST" action="<?php echo base_url();?>csh/buy">
	       	  	<div class="col-md-12">
	       	  		<?php
	       	  		
	       	  		?>
	       	  		<div class="col-md-3 pull-left">
	       	  			Nama buku
	       	  		</div>
	       	  		<div class="col-md-3 pull-left">
	       	  			harga buku
	       	  		</div>
	       	  		<div class="col-md-3 pull-left">
	       	  			kuantitas
	       	  		</div>
	       	  		<div class="col-md-3 pull-left">
	       	  			total
	       	  		</div>
	       	  	</div>
	       	  	<div class="col-md-12">
	       	  		<input name="qty" id="qty" type="hidden" value="10">
	       	  	</div>

	            <input type="submit" name="buy" class="login loginmodal-submit" value="Buy">
	          </form>
	      </div>
	    </div>
	</div>
</body>
</html>
<script>
	function showModalConfirm(){
		$('#ConfirmModal').modal({
		    backdrop: 'false',
		    show: true,
		    keyboard: false  // to prevent closing with Esc button (if you want this too)
		});
	}
</script>