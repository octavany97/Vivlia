<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $css; ?>
	<?php echo $js; ?>
</head>
<body>
	<?php echo $header; ?>
	<?php echo $menuheader; ?>
	<?php echo $sidebar; ?>
	</nav>
	<div id="page-wrapper">

		<div class="jumbotron text-center" style="min-height: 350px; background-color: lightblue;"  >
		  
			
			<img id="pc01" alt="<?php echo $this->session->userdata('username')?>" style="width:10%;" src="<?php echo base_url(); ?>assets/uploads/profiles/default.png">
			<h3><?php echo $this->session->userdata('username')?></h3> 
		 	<h3><a href="#" style="position: absolute;padding-top: 1%; right: 100px; " class="fa fa-facebook"></a></h3>
			<h3><a href="#" style="position: absolute;padding-top: 1%; right: 150px; " class="fa fa-twitter"></a></h3>
			<h3><a href="#" style="position: absolute;padding-top: 1%; right: 200px; " class="fa fa-instagram"></a></h3>
		</div>

			<!-- The Modal -->
			<!-- <div id="myModal1" class="modal1">
			  <span class="close">&times;</span>
			  <img class="modal1-content" id="1img">
			  <div id="caption1"></div>
			</div>	
			<script>
				// Get the modal
				var modal = document.getElementById('myModal1');

				// Get the image and insert it inside the modal - use its "alt" text as a caption
				var img = document.getElementById('pc01');
				var modalImg = document.getElementById("1img");
				var captionText = document.getElementById("caption1");
				img.onclick = function(){
				    modal.style.display = "block";
				    modalImg.src = this.src;
				    captionText.innerHTML = this.alt;
				}

				// Get the <span> element that closes the modal
				var span = document.getElementsByClassName("close")[0];

				// When the user clicks on <span> (x), close the modal
				span.onclick = function() { 
				    modal.style.display = "none";
				}
			</script> -->
		<div class="form-group" style="padding-bottom: 30px;">
			 <label class="col-md-3 control-label" for="name">Username</label>  
			 <div class="col-md-9">
		  		<input id="id_form1" name="id_form1" type="text" class="form-control input-md" value="<?php echo $user['username']?>" readonly>
		  	 </div>
		</div>

		<div class="form-group" style="padding-bottom: 30px;">
			 <label class="col-md-3 control-label" for="name">Position</label>  
			 <div class="col-md-9">
		  		<input id="id_form2" name="id_form2" type="text" class="form-control input-md" value="<?php echo $user['nama_peran']?>" readonly>
		  	 </div>
		</div>

		<div class="form-group" style="padding-bottom: 30px;">
			 <label class="col-md-3 control-label" for="name">Email</label>  
			 <div class="col-md-9">
		  		<input id="id_form3" name="id_form3" type="text" class="form-control input-md" value="<?php echo $user['email']?>" readonly>
		  	 </div>
		</div>

		<div class="form-group" style="padding-bottom: 30px;">
			 <label class="col-md-3 control-label" for="name">Nama toko</label>  
			 <div class="col-md-9">
		  		<input id="id_form4" name="id_form2" type="text" class="form-control input-md" value="<?php echo $user['nama_toko']?>" readonly>
		  	 </div>
		</div>

		<div class="form-group" style="padding-bottom: 30px;">
			 <label class="col-md-3 control-label" for="name">IP address</label>  
			 <div class="col-md-9">
		  		<input id="id_form5" name="id_form3" type="text" class="form-control input-md" value="<?php echo $user['ip_addr']?>" readonly>
		  	 </div>
		</div>

		<div class="form-group" id="btn-area">		
			<button type="button" onclick="removeAlignment()" id="btnedit" class="btn btn-primary" name="btnedit">Edit</button>
<!-- 				<button type="button"  class="btn btn-warning" name="btnCancel">Cancel</button> -->
			</div>
		</div>
			
		

<script>
	  function removeAlignment(){
   		 var read1 = document.getElementById("id_form1").removeAttribute("readonly",0);
   		 // var read2 = document.getElementById("id_form2").removeAttribute("readonly",0);
   		 var read3 = document.getElementById("id_form3").removeAttribute("readonly",0);
   		 var read4 = document.getElementById("id_form4").removeAttribute("readonly",0);
  		 var read5 = document.getElementById("id_form5").removeAttribute("readonly",0);
  		 document.getElementById('btn-area').innerHTML = '';
  		 document.getElementById('btn-area').innerHTML = '<button type="button" onclick="save()" id="btnsave" class="btn btn-primary" name="btnsave">Apply</button><button type="button" onclick="cancel()"  class="btn btn-danger" name="btnCancel">Cancel</button></div>';
  		 console.log("btn edit")
  	  }
  	  function cancel(){
  	  	 var read1 = document.getElementById("id_form1").setAttribute("readonly",1);
   		 // var read2 = document.getElementById("id_form2").removeAttribute("readonly",0);
   		 var read3 = document.getElementById("id_form3").setAttribute("readonly",1);
   		 var read4 = document.getElementById("id_form4").setAttribute("readonly",1);
  		 var read5 = document.getElementById("id_form5").setAttribute("readonly",1);
  		 document.getElementById('btn-area').innerHTML = '';
  		 document.getElementById('btn-area').innerHTML = '<button type="button" onclick="removeAlignment()" id="btnedit" class="btn btn-primary" name="btnedit">Edit</button>';
  		 console.log("btn cancel")
  	  }
  	
  	</script>			

</body>
</html>