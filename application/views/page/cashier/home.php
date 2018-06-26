<!DOCTYPE html>
<html>
<head>
	<title>Vivlia</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<?php echo $css; ?>
	<?php echo $js; ?>
</head>
<body onload="initialize()">
	<?php echo $header;
	echo $menuheader;
	echo $sidebar;
	?>
	</nav>
	<div id="page-wrapper">
		<div class="col-md-12" id="success"></div>
		<div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Vivlia <b>Cashier</b></h2>
					</div>
					<div class="col-sm-6">
						<button name="add" style="min-width: 130px;" id="add" class="btn btn-success" onclick="showModalAdd()"><i class="material-icons">&#xe854;</i> <span>Add Product</span></button>
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
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="txtHint">
                </tbody>
                <tfoot class="container table-title" style="background-color: white; color: #566787">
                	<tr>
                		<th></th>
                		<th></th>
                		<th></th>
                		<th>Grand Total</th>
                		<th id="grandTotal"></th>
                		<th><button name="confirm" style="min-width:130px;" id="confirm" class="btn btn-success" onclick="showModalConfirm()"><i class="material-icons">&#xe8a1;</i> <span>Confirm</span></button></th>
                	</tr>
                </tfoot>
            </table>

        </div>
		
	</div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<h1>Add Product</h1>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<br><br>
				<div class="form-group">
					<label>Product Code</label>
					<input type="text" id="kode" class="form-control" required name="kode">
				</div>
				<div class="form-group">
					<label>Quantity</label>
					<input type="text" id = "qty" class="form-control" required name="qty">
				</div>				
				<input type="submit" id="btn_add" class="login loginmodal-submit" value="Add">
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="loginmodal-container">
				<h1>Delete Product</h1>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<br><br>
				<input type="hidden" id="id_hidden" name="id_hidden">
				<p style="font-size: 15px;">Are you sure you want to delete these Records?</p>
				<p class="text-warning" style="font-size: 14px;"><small>This action cannot be undone.</small></p>
				<!-- action button -->
				<input type="submit" class="login loginmodal-submit" id="btn_del" value="Delete">
			</div>
		</div>
	</div>
	<div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
	    <div class="modal-dialog">
	      <div class="loginmodal-container">
	          <h1>Confirm Purchases?</h1>
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <br><br>
	          <div>Please Check The Purchase Again</div>
	          <br>
	          <form method="POST" action="<?php echo base_url();?>csh/buy">
	       	  	<div class="col-md-12">
	       	  		<input name="qty" id="qty" type="hidden">
	       	  	</div>

	            <input type="submit" name="buy" id="btn_confirm" class="login loginmodal-submit" value="Buy">
	          </form>
	      </div>
	    </div>
	</div>
</body>
</html>
<script>
$(document).ready(function(){
	
	$( "#btn_add" ).click(function() {
		var data = $("#form_add").serializeArray();
		var productId = $('#kode').val();
		var quantity = $('#qty').val();
		var idtoko = 1;
		var idx = 0;
		var t = JSON.parse(localStorage.getItem('temp_item'))
		if(t.length > 0) idx = t.length;
		
		$.ajax({
			method:"POST",
			url:'<?php echo base_url() ?>csh/addItem',
			data: "id="+productId+"&qty="+quantity+"&tokoid="+idtoko+"&idx="+(idx+1),
			success: function(response){
				var obj = JSON.parse(response);
				
				var data = JSON.parse(localStorage.getItem('temp_item'))

				var row = document.createElement('tr'); // create row node
			    var col = document.createElement('td'); // create column node
			    var col2 = document.createElement('td'); // create second column node
			    var col3 = document.createElement('td'); // create third node
			    var col4 = document.createElement('td'); // create fourth column node
			    var col5 = document.createElement('td'); // create fifth column node
			    var col6 = document.createElement('td'); // create sixth column node
			    row.appendChild(col); // append first column to row
			    row.appendChild(col2); // append second column to row
			    row.appendChild(col3);
			    row.appendChild(col4);
			    row.appendChild(col5);
			    row.appendChild(col6);
			    
			    col2.setAttribute('style', 'min-width:180px;')
			    col4.setAttribute('style', 'min-width:130px;')
			    col5.setAttribute('style', 'min-width:130px;')
			    col6.setAttribute('style', 'min-width:50px;')
			    col.innerHTML = idx+1;
			    col2.innerHTML = obj.nama;
			    col3.innerHTML = obj.qty;
			    col4.innerHTML = obj.price;
			    col5.innerHTML = obj.total;
			    col6.innerHTML = "<button class='btn btn-xs btn-danger' name='delete' id='delete' onclick='showModalDelete("+(idx+1)+")' id='delete'><i class='material-icons' style='font-size:18px'>&#xe872;</i></button>"
			    var table = document.getElementById("txtHint"); // find table to append to
      			table.appendChild(row); // append row to table
      			var addItem = []
      			var total = 0;
      			for(let i = 0;i < data.length;i++){
      				addItem.push(data[i]);
      				total = total + data[i].total;
      			}
      			var addItem1 = obj;
      			addItem.push(addItem1)
      			localStorage.setItem('temp_item', JSON.stringify(addItem));
      			total = total + obj.total;
      			var stored = JSON.parse(localStorage.getItem('temp_item'))

      			document.getElementById('grandTotal').innerHTML = "Rp. "+total+",00";
      			
				$("#addEmployeeModal").modal('hide');
				document.getElementById('kode').value = ''
				document.getElementById('qty').value = ''
			}

		})
	});
	$('#btn_del').click(function(){
		let id = document.getElementById('id_hidden').value
		var data = JSON.parse(localStorage.getItem('temp_item'))
		data.splice((id-1), 1);
		localStorage.setItem('temp_item', JSON.stringify(data));
		var table = document.getElementById("txtHint"); // find table to append to
		table.innerHTML = '';
		var total = 0;
		for (var i = 0; i < data.length; i++) {
			var row = document.createElement('tr'); // create row node
		    var col = document.createElement('td'); // create column node
		    var col2 = document.createElement('td'); // create second column node
		    var col3 = document.createElement('td'); // create third node
		    var col4 = document.createElement('td'); // create fourth column node
		    var col5 = document.createElement('td'); // create fifth column node
		    var col6 = document.createElement('td'); // create sixth column node

		    col2.setAttribute('style', 'min-width:180px;')
		    col4.setAttribute('style', 'min-width:130px;')
		    col5.setAttribute('style', 'min-width:130px;')
		    col6.setAttribute('style', 'min-width:50px;')
		    row.appendChild(col); // append first column to row
		    row.appendChild(col2); // append second column to row
		    row.appendChild(col3);
		    row.appendChild(col4);
		    row.appendChild(col5);
		    row.appendChild(col6);
		    
		    col.innerHTML = i+1;
		    col2.innerHTML = data[i].nama;
		    col3.innerHTML = data[i].qty;
		    col4.innerHTML = "Rp. "+data[i].price+",00";
		    col5.innerHTML = "Rp. "+data[i].total+",00";
		    col6.innerHTML = "<button class='btn btn-danger btn-xs' name='delete' id='delete' onclick='showModalDelete("+(i+1)+")' id='delete'><i class='material-icons' style='font-size:18px'>&#xe872;</i></button>"
		    total = total + data[i].total
  			table.appendChild(row); // append row to table
		}
		document.getElementById('grandTotal').innerHTML = "Rp. "+total+",00"
		$("#deleteEmployeeModal").modal('hide');
	})
	$("#btn_confirm").click(function(){
		var total = document.getElementById('grandTotal').innerHTML
		var data = localStorage.getItem('temp_item')
		console.log(total)

		$.ajax({
			method: "POST",
			url: "<?php echo base_url(); ?>csh/buy",
			data: 'total=200000',
			success: function(classes){
				$('#success').innerHTML = "Transaction has been added!"
			},
			error: function(xhr, status){
				alert("Oops there is an error!")
			}
		})
	})
});
	function showModalConfirm(){
		$('#ConfirmModal').modal({
		    backdrop: 'false',
		    show: true,
		    keyboard: false  // to prevent closing with Esc button (if you want this too)
		});
	}
	function showModalAdd(){
		$('#addEmployeeModal').modal({
		    backdrop: 'false',
		    show: true,
		    keyboard: false  // to prevent closing with Esc button (if you want this too)
		});
	}
	function showModalDelete(id){
		$('#deleteEmployeeModal').modal({
		    backdrop: 'false',
		    show: true,
		    keyboard: false  // to prevent closing with Esc button (if you want this too)
		});
		
		document.getElementById('id_hidden').value = id;
	}
	
	function renderAllItems(items){
		item = JSON.parse(JSON.stringify(items));
		const table = document.getElementById('txtHint')
		table.innerHTML = ''
		var total = 0
		
		for (var i = 0; i <= items.length - 1; i++) {
			
			var row = document.createElement('tr'); // create row node
		    var col = document.createElement('td'); // create column node
		    var col2 = document.createElement('td'); // create second column node
		    var col3 = document.createElement('td'); // create third node
		    var col4 = document.createElement('td'); // create fourth column node
		    var col5 = document.createElement('td'); // create fifth column node
		    var col6 = document.createElement('td'); // create sixth column node
		    row.appendChild(col); // append first column to row
		    row.appendChild(col2); // append second column to row
		    row.appendChild(col3);
		    row.appendChild(col4);
		    row.appendChild(col5);
		    row.appendChild(col6);
		    col2.setAttribute('style', 'min-width:180px;')
		    col4.setAttribute('style', 'min-width:130px;')
		    col5.setAttribute('style', 'min-width:130px;')
		    col6.setAttribute('style', 'min-width:50px;')
		    col.innerHTML = i+1;
		    col2.innerHTML = items[i].nama;
		    col3.innerHTML = items[i].qty;
		    col4.innerHTML = "Rp. " + items[i].price+",00";
		    col5.innerHTML = "Rp. "+items[i].total+",00";
		    col6.innerHTML = "<button class='btn btn-xs btn-danger' name='delete' id='delete' onclick='showModalDelete("+(i+1)+")' id='delete'><i class='material-icons' style='font-size:18px'>&#xe872;</i></button>"
		    total = total + items[i].total

		 	table.appendChild(row)
		}
		
		document.getElementById('grandTotal').innerHTML = "Rp. "+total+",00"
		//item.forEach(item => renderItem(item))
	}
	function initialize(){
		let items = localStorage.getItem("temp_item")
		if(items == null){
			var data = {}
			localStorage.setItem("temp_item", JSON.stringify(data))

			items = localStorage.getItem("temp_item")
		}
		items = JSON.parse(items)

		renderAllItems(items)

	}
</script>