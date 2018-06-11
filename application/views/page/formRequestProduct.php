<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php echo $css; ?>
</head>
<body>
	<?php echo $header; ?>
	<?php echo $menuheader; ?>
	<?php echo $sidebar; ?>	
	</nav>
	<div class="col-md-10 pull-right">
		
	<div class="container">
		<div class="row">
			<form class="form-horizontal">
			<fieldset>

			<!-- Form Name -->
			<div class="form-group">
				<legend>Product Request</legend>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="name">Form Request ID</label>  
			  <div class="col-md-6">
			  	<input id="id_form" name="id_form" type="text" class="form-control input-md" readonly>
			    
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="product_name">Product Name</label>  
			  <div class="col-md-6">
			  <input id="product_name" name="product_name" type="text" placeholder="Product Name" class="form-control input-md" autocomplete="on" required="">
			    
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="id_product">Product ID</label>  
			  <div class="col-md-6">
			  <input id="id_product" name="id_product" type="text" placeholder="Product ID" class="form-control input-md" required="">
			    
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="qty">Quantity</label>  
			  <div class="col-md-6">
			  <input id="qty" name="qty" type="number" placeholder="Quantity" class="form-control input-md" required="">
			    
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="description">Description</label>  
			  <div class="col-md-6">
			  <textarea id="description" name="description" type="text" placeholder="Description" class="form-control input-md" required="">
			  		
			  </textarea> 
			    
			  </div>
			</div>
			</fieldset>
			</form>
		</div>
	</div>
	</div>
</body>
<?php echo $js; ?>
</html>