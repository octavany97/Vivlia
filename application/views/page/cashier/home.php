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
		<div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Vivlia <b>Cashier</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add Product</span></a>			
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
						<th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="txtHint">
                </tbody>
            </table>
        </div>
		<button name="confirm" id="confirm" class="btn btn-success" onclick="showModalConfirm()">Confirm</button>			
	</div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form_add" method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Add Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Product Code</label>
							<input type="text" id="kode" class="form-control" required name="kode">
						</div>
						<div class="form-group">
							<label>Quantity</label>
							<input type="text" id = "qty" class="form-control" required name="qty">
						</div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="button" id="btn_add" onclick="createRow()" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="button" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
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
	function createRow(){
	  var row = document.createElement('tr'); // create row node
      var col = document.createElement('td'); // create column node
      var col2 = document.createElement('td'); // create second column node
      row.appendChild(col); // append first column to row
      row.appendChild(col2); // append second column to row
      col.innerHTML = "qwe"; // put data in first column
      col2.innerHTML = "rty"; // put data in second column
      var table = document.getElementById("txtHint"); // find table to append to
      table.appendChild(row); // append row to table
	}
$(document).ready(function(){
	$( "#btn_add" ).click(function() {
		var data = $("#form_add").serializeArray();
		var productId = $('#kode').val();
		var quantity = $('#qty').val();
		var idtoko = 1;
		console.log(data)
		console.log(productId + " " + quantity);
		//$('#txtHint')
		$.ajax({
			method:"POST",
			url:'controllerCashier.php',
			data: "id="+productId+"&qty="+quantity+"&tokoid="+idtoko,
			success: function(response){
				console.log(response)
				$("#addEmployeeModal").modal('hide');
			}

		})
	});
});
	function showModalConfirm(){
		$('#ConfirmModal').modal({
		    backdrop: 'false',
		    show: true,
		    keyboard: false  // to prevent closing with Esc button (if you want this too)
		});
	}
</script>