<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
			<form autocomplete="off" class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/ManagerController/form_request">
			<fieldset>
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="name">Form Request ID</label>  
			  <div class="col-md-6">
			  	<input id="id_form" name="id_form" type="text" class="form-control input-md" value="<?php echo $id_form;?>" disabled>
			  </div>
			</div>
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="product_name">Product Name</label>  
			  <div class="col-md-3">
			  <input id="product_name" name="product_name" type="text" placeholder="Product Name" class="form-control input-md">
			  </div>
			  <label class="col-md-1 control-label" for="qty">Quantity</label>  
			  <div class="col-md-2">
			  <input id="qty" name="qty" type="number" placeholder="Quantity" class="form-control input-md">
			  </div>
			  <div class="input-group-btn">
            		<button class="btn btn-success" type="button"  onclick="product_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
          	  </div>
			</div>

			<!-- buat product klo nambah -->
			<div id="product_fields">
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-3 control-label" for="description">Description</label>  
			  <div class="col-md-6">
			  <textarea id="description" name="description" type="text" placeholder="Description" class="form-control input-md">
			  </textarea> 
			  </div>
			</div>

			<div class="form-group">
				<button type="button" onclick="showModalRequest()" class="btn btn-primary" name="btnRequest">Request</button>
				<button type="button" onclick="showModalCancel()" class="btn btn-warning" name="btnCancel">Cancel</button>
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
			          <button type="submit" class="btn btn-primary" name="btnRequest">Yes</button>
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
	function product_fields() {
	 
	    room++;
	    var objTo = document.getElementById('product_fields')
	    var divtest = document.createElement("div");
		divtest.setAttribute("class", "form-group removeclass"+room);
		var rdiv = 'removeclass'+room;
		divtest.innerHTML = '<label class="col-md-3 control-label" for="product_name">Product Name</label><div class="col-md-3"><input id="product_name'+room+'" onfocus="addAutocomplete('+room+')" name="product_name'+room+'" type="text" placeholder="Product Name" class="form-control input-md" autocomplete="on"></div><label class="col-md-1 control-label" for="qty">Quantity</label><div class="col-md-2"><input id="qty'+room+'" name="qty'+room+'" type="number" placeholder="Quantity" class="form-control input-md" ></div><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_product_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div>';
	    objTo.appendChild(divtest)
	}
   function remove_product_fields(rid) {
	   $('.removeclass'+rid).remove();
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
<script type="text/javascript">
	function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
} 

</script>
 <script>
 autocomplete(document.getElementById("product_name"), array);
 function addAutocomplete(id){
 	autocomplete(document.getElementById("product_name"+id), array)
 }
</script> 
</html>