<!DOCTYPE html>
<html>
<head>
	<title>Vivlia</title>
	<?php echo $css; ?>
</head>
<body>
	<?php echo $header; ?>
	<?php echo $menuheader; ?>
	<?php echo $sidebar; ?>	
	</nav>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
            	<h1 class="page-header">Form Request Product</h1>    
            </div>
		</div>
		<div class="row">
			<form class="form-horizontal">
			<fieldset>
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="name">Form Request ID</label>  
			  <div class="col-md-6">
			  	<input id="id_form" name="id_form" type="text" class="form-control input-md" readonly>
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="product_name">Product Name</label>  
			  <div class="col-md-6">
			  <input id="product_name" name="product_name" type="text" placeholder="Product Name" class="form-control input-md" autocomplete="on" required="">
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="id_product">Product ID</label>  
			  <div class="col-md-6">
			  <input id="id_product" name="id_product" type="text" placeholder="Product ID" class="form-control input-md" required="">
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="qty">Quantity</label>  
			  <div class="col-md-6">
			  <input id="qty" name="qty" type="number" placeholder="Quantity" class="form-control input-md" required="">
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="description">Description</label>  
			  <div class="col-md-6">
			  <textarea id="description" name="description" type="text" placeholder="Description" class="form-control input-md" required="">
			  </textarea> 
			  </div>
			</div>
			</fieldset>
			</form>
		</div>
	</div>
	
</body>
<?php echo $js; ?>
</html>