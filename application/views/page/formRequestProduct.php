<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Vivlia</title>
	<?php echo $css; ?>
</head>
<body onload="initialize()">
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
			<form id="request" name="request" autocomplete="off" class="form-horizontal" method="POST"  enctype="multipart/form-data">
			<fieldset>
			<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-2 control-label" for="name">Form Request ID</label>  
				  <div class="col-md-9">
				  	<input id="id_form" name="id_form" type="text" class="form-control input-md" value="<?php echo $id_form;?>" disabled>
				  </div>
				</div>
				<!-- Text input-->
				<div class="form-group" id="columns">
				  <label class="col-md-2 control-label" for="product_name">Product ISBN</label>  
				  <div class="col-md-2">
					  <input id="product_name1" name="product_name1" type="text" placeholder="Product ISBN" class="form-control input-md" list="buku" >
					  <label style="color: red;"><?php echo form_error('product_name1');?>
					  
					  	<datalist id="buku">
					  		<?php
					  		foreach ($title as $row) {
				  			?>
								<option value="<?php echo $row['isbn']; ?>"><?php echo $row['nama_buku']; ?></option>
							<?php
					  		}
					  		?>
					  	</datalist>
				  </div>
				  <label class="col-md-1 control-label" for="productName1">Product Name</label>
				  <div class="col-md-4">
				  	<input type="text" name="productName1" class="form-control input-md" id="productName1" readonly>
				  	<input type="hidden" name="idbuku1" id="idbuku1">
				  </div>
				  <label class="col-md-1 control-label" for="qty">Quantity</label>  
				  <div class="col-md-1">
				  	<input id="qty1" name="qty1" type="number" min="0" placeholder="Quantity" class="form-control input-md" >
				  	<label style="color: red;"><?php echo form_error('qty1');?></label>
				  	
				  </div>
				  <div class="input-group-btn" id="btn-action1">
	            	<button class="btn btn-success" type="button" onclick="product_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
	          	  </div>
				</div>

				<!-- buat product klo nambah -->
				<div id="product_fields">
				</div>

				<div class="col-md-2"></div>
				<div class="col-md-2">
					<label style="color: red; padding-top:0px;" id="msg_error_isbn"></label>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-4"></div>
				<div class="col-md-2">
					<label style="color: red; padding-left: 30px;" id="msg_error_qty"></label>
				</div>
				<!-- Text input-->
				<br><br>
				<div class="form-group">
				  <label class="col-md-2 control-label" for="description">Description</label>  
				  <div class="col-md-9">
				  <textarea id="description" name="description" type="text" placeholder="Description" class="form-control input-md">
				  </textarea> 
				  </div>
				</div>

				<div class="form-group" style="text-align: center;">
					<button type="button" onclick="showModalRequest()" class="btn btn-primary" name="btnRequest">Request</button>
					<button type="button" onclick="showModalCancel()" class="btn btn-danger" name="btnCancel">Cancel</button>
				</div>
			</fieldset>

			<!-- start modal cancel -->
			<div class="modal fade" id="cancelModal" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-body">
			          <p>You have unsaved changes. Are you sure you want to leave this page?</p>
			        </div>
			        <div class="modal-footer">
			          <button type="submit" class="btn btn-primary" name="btnCancel">Yes</button>
			          <button type="submit" class="btn btn-danger" data-dismiss="modal">No</button>
			        </div>
			      </div>
			      
			    </div>
			  </div>
			  <!-- end modal cancel -->

			  <!-- start modal request -->
			  <div class="modal fade" id="requestModal" role="dialog">
			    <div class="modal-dialog">
			    
			      <!-- Modal content-->
			      <div class="modal-content">
			        <div class="modal-body">
			          <p>Are you sure the data entered are correct?</p>
			        </div>
			        <div class="modal-footer">
			          <button type="submit" class="btn btn-primary" data-dismiss="modal" name="btn_request" id="btn_request" onclick="requestBook(<?php echo $this->session->userdata('id_user');?>)">Yes</button>
			          <button type="submit" class="btn btn-danger" data-dismiss="modal">No</button>
			        </div>
			      </div>
			      
			    </div>
			  </div>
			  <!-- end modal request -->

			</form>
		</div>
	</div>
</body>
<?php echo $js; ?>
<?php 
	$array = array();
	foreach ($title as $res) {
		$array[] = $res['nama_buku'];
	}
	echo '<script> var array = '.json_encode($array).';</script>';
?>
<script src="<?php echo base_url().'assets/vendor/jquery/jquery-ui.js';?>"></script>
<script type="text/javascript">
	var room = 1;
	var empty_isbn = false;
	var empty_qty = false;
	function isEmpty(n){
		var isbn = document.getElementById("product_name" + room);
		var name = document.getElementById("productName"+room);
		var qty = document.getElementById("qty" + room);
		var idbuku = document.getElementById("idbuku"+room);
		
	      if (isbn.value == "")
	      {
	      	 isbn.setAttribute("required","")
	      	 isbn.setAttribute("style","border-color: red")
	         empty_isbn = true;
	         document.getElementById("msg_error_isbn").innerHTML = "Please fill out this field."
	      }
	      else{

	      	$.ajax({
				method: "POST",
				url: "<?php echo base_url(); ?>mgr/checkISBN/",
				data: 'isbn='+isbn.value,
				success: function(classes){
					if(classes == "false"){
						empty_isbn = true;
						document.getElementById("msg_error_isbn").innerHTML = "Please check again."
					}
					else{
						let obj = JSON.parse(classes)
						name.value = obj.nama_buku
						idbuku.value = obj.id_buku

						if(qty.value != ""){
							var idtoko = 1;
							var idx = 0;
							var temp = '{"no":'+(room-1)+',"id_buku":'+idbuku.value+',"isbn":"'+isbn.value+'","nama_buku":"'+name.value+'","quantity":'+qty.value+'}';
							var obj2 = JSON.parse(temp)
							var data = JSON.parse(localStorage.getItem('product_request'))
							if(data.length > 0) idx = data.length;

							var addItem = []
							for(let i = 0;i < data.length;i++){
								addItem.push(data[i]);
							}

							var addItem1 = obj2;
							addItem.push(addItem1)
							localStorage.setItem('product_request', JSON.stringify(addItem));	
						}
						
						isbn.removeAttribute("style")
						empty_isbn = false;
						document.getElementById("msg_error_isbn").innerHTML = ""
					}
				},
				error: function(xhr, status){
					alert("Oops there is an error!")
				}
			})
	      	
	      }
	      if(qty.value == "")
	      {
	      	 qty.setAttribute("style","border-color: red")
	      	 qty.setAttribute('required',"")
	         empty_qty = true;
	         document.getElementById("msg_error_qty").innerHTML = "Minimum number is 1"		         
	      }
	      else{
	      	empty_qty = false;
	      	qty.removeAttribute("style")
	      	document.getElementById("msg_error_qty").innerHTML = ""
	      }
		if(!empty_isbn && !empty_qty){
			var divBtn = document.getElementById("btn-action"+room)
			var btnEdit = document.createElement("button")
			var span = document.createElement("span")
			
			btnEdit.className = "btn btn-primary"
			btnEdit.id = "edit_btn"+room
			btnEdit.name = "edit_btn"+room
			btnEdit.type = "button"
			//btnEdit.onclick = "edit_product_fields("+room+")"
			span.className = "glyphicon glyphicon-edit"
			btnEdit.appendChild(span)
			divBtn.appendChild(btnEdit)
			
			document.getElementById('edit_btn'+room).setAttribute("onclick","edit_product_fields("+room+")")
			isbn.setAttribute("readonly","")
			qty.setAttribute("readonly","")

			return false;
		}
		else{
			return true;
		}
	}


	function product_fields() {
		if(!isEmpty(room)){
		    room++;
		    //console.log(room)
		    var objTo = document.getElementById('product_fields')
		    var divtest = document.createElement("div");
			divtest.setAttribute("class", "form-group removeclass"+room);
			var rdiv = 'removeclass'+room;
			divtest.innerHTML = '<label class="col-md-2 control-label" for="product_name'+room+'">Product ISBN</label><div class="col-md-2"><input id="product_name'+room+'" list="buku" name="product_name'+room+'" type="text" placeholder="Product ISBN" class="form-control input-md" autocomplete="on"></div><label class="col-md-1 control-label" for="productName'+room+'">Product Name</label><div class="col-md-4"><input id="productName'+room+'" readonly name="productName'+room+'" type="text" placeholder="Product Name" class="form-control input-md" autocomplete="on"><input type="hidden" name="idbuku'+room+'" id="idbuku'+room+'"></div><label class="col-md-1 control-label" for="qty">Quantity</label><div class="col-md-1"><input id="qty'+room+'" name="qty'+room+'" type="number" placeholder="Quantity" class="form-control input-md" ></div><div class="input-group-btn" id="btn-action'+room+'"> <button class="btn btn-danger" type="button" onclick="remove_product_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div>';
		    objTo.appendChild(divtest)
		}
	}
	function edit_product_fields(rid){
		var isbn = document.getElementById('product_name'+rid)
		var name = document.getElementById('productName'+rid)
		var idbuku = document.getElementById('idbuku'+rid)
	   	var qty = document.getElementById('qty'+rid)
	   	var btn_edit = document.getElementById('edit_btn'+rid)

	   	if(btn_edit.innerHTML == '<span class="glyphicon glyphicon-floppy-save"></span>'){
	   		btn_edit.innerHTML = '<span class="glyphicon glyphicon-edit"></span>'
	   		var temp = []
	   		var data = JSON.parse(localStorage.getItem('product_request'))
	   		for(let i = 0;i < data.length;i++){
	   			if((i+1) == rid){
	   				var temp2 = '{"no":'+rid+',"id_buku":'+idbuku.value+',"isbn":"'+isbn.value+'","nama_buku":"'+name.value+'","quantity":'+qty.value+'}';
					temp.push(JSON.parse(temp2))
	   			}
	   			else{
	   				temp.push(data[i]);
	   			}
	   		}
	   		localStorage.setItem('product_request',"[]")
	   		localStorage.setItem('product_request',JSON.stringify(temp))
	   		isbn.setAttribute('readonly','')
	   		qty.setAttribute('readonly','')
	   	}
	   	else if(btn_edit.innerHTML == '<span class="glyphicon glyphicon-edit"></span>'){
	   		btn_edit.innerHTML = '<span class="glyphicon glyphicon-floppy-save"></span>'	
	   		isbn.removeAttribute("readonly")
	   		qty.removeAttribute("readonly")
	   	}	   	
	}
    function remove_product_fields(rid) {
	    //$('.removeclass'+rid).remove();
	    room--;
	   	// var parent = document.getElementById('btn-action'+room)
	   	// var child = document.getElementById('edit_btn'+room)
	   	// parent.removeChild(child)
	   	var isbn = document.getElementById('product_name'+room)
	   	var qty = document.getElementById('qty'+room)
	   	var fields = document.getElementById('product_fields')
	   	fields.innerHTML = ''

	   	var temp = []
   		var data = JSON.parse(localStorage.getItem('product_request'))
   		let ctr = 1

   		for(let i = 0;i < data.length;i++){
   			if((i+1) == rid){
   				
   			}
   			else{
   				//masukkin lagi ke array temp
   				temp.push(data[i]);

 				//buat ulang 
 				if(i > 0 && i < data.length - 1){
 					var divtest = document.createElement("div");
					divtest.setAttribute("class", "form-group removeclass"+ctr);
					var rdiv = 'removeclass'+ctr;
					divtest.innerHTML = '<label class="col-md-2 control-label" for="product_name'+ctr+'">Product ISBN</label><div class="col-md-2"><input id="product_name'+ctr+'" list="buku" name="product_name'+ctr+'" type="text" placeholder="Product ISBN" class="form-control input-md" autocomplete="on" value="'+data[i].isbn+'" readonly></div><label class="col-md-1 control-label" for="productName'+ctr+'">Product Name</label><div class="col-md-4"><input id="productName'+ctr+'" readonly name="productName'+ctr+'" type="text" placeholder="Product Name" class="form-control input-md" autocomplete="on" value="'+data[i].nama_buku+'" readonly><input type="hidden" name="idbuku'+ctr+'" id="idbuku'+ctr+'" value="'+data[i].id_buku+'"></div><label class="col-md-1 control-label" for="qty">Quantity</label><div class="col-md-1"><input id="qty'+ctr+'" name="qty'+ctr+'" type="number" placeholder="Quantity" class="form-control input-md" value="'+data[i].quantity+'" readonly></div><div class="input-group-btn" id="btn-action'+ctr+'"> <button class="btn btn-danger" type="button" onclick="remove_product_fields('+ ctr +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button><button class="btn btn-primary" type="button" onclick="edit_product_fields('+ ctr +');"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> </button></div>';
				    fields.appendChild(divtest)	
 				}
			    else if(i == data.length-1){
			    	var divtest = document.createElement("div");
					divtest.setAttribute("class", "form-group removeclass"+ctr);
					var rdiv = 'removeclass'+ctr;
					divtest.innerHTML = '<label class="col-md-2 control-label" for="product_name'+ctr+'">Product ISBN</label><div class="col-md-2"><input id="product_name'+ctr+'" list="buku" name="product_name'+ctr+'" type="text" placeholder="Product ISBN" class="form-control input-md" autocomplete="on" value="'+data[i].isbn+'"></div><label class="col-md-1 control-label" for="productName'+ctr+'">Product Name</label><div class="col-md-4"><input id="productName'+ctr+'" name="productName'+ctr+'" type="text" placeholder="Product Name" class="form-control input-md" autocomplete="on" value="'+data[i].nama_buku+'" readonly><input type="hidden" name="idbuku'+ctr+'" id="idbuku'+ctr+'" value="'+data[i].id_buku+'"></div><label class="col-md-1 control-label" for="qty">Quantity</label><div class="col-md-1"><input id="qty'+ctr+'" name="qty'+ctr+'" type="number" placeholder="Quantity" class="form-control input-md" value="'+data[i].quantity+'"></div><div class="input-group-btn" id="btn-action'+ctr+'"> <button class="btn btn-danger" type="button" onclick="remove_product_fields('+ ctr +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div>';
				    fields.appendChild(divtest)		
			    }
   				ctr++;

   			}
   			room = ctr-1;
   		}
   		localStorage.setItem('product_request',"[]")
   		localStorage.setItem('product_request',JSON.stringify(temp))   	
    }
    // dijalankan ketika btn_request di modal request diklik
    function requestBook(id_user) {
    	var id_form = $('#id_form').val()
    	var desc = $('#description').val()
    	var data = JSON.stringify(localStorage.getItem('product_request'))
    	console.log(data)
    	$.ajax({
			method: "POST",
			url: "<?php echo base_url(); ?>mgr/insertRequestBook/",
			data: 'id_form='+id_form+'&id_user='+id_user+'&desc='+desc+'&data='+data,
			success: function(classes){
				console.log(classes)
			},
			error: function(xhr, status){
				alert("Oops there is an error!")
			}
		})
    }

	function initialize(){
		let items = localStorage.getItem("product_request");
		localStorage.setItem('product_request',"[]")
		if(items == null){
			var data = {}
			localStorage.setItem("product_request", JSON.stringify(data))

			items = localStorage.getItem("product_request")
		}
		items = JSON.parse(items)
	
		document.getElementById('description').innerHTML = ''
	}

   function showModalCancel(){
   		$('#cancelModal').modal({
		    backdrop: 'false',
		    show: true,
		    keyboard: true  // to prevent closing with Esc button (if you want this too)
		});
   }
   function showModalRequest(){
   		$('#requestModal').modal({
		    backdrop: 'false',
		    show: true,
		    keyboard: true  // to prevent closing with Esc button (if you want this too)
		});
   }
</script>
</html>