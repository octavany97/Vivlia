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
		  
			
			<img id="pc01" alt="<?php echo $this->session->userdata('username')?>" style="width:100%;max-width:300px" src="<?php echo base_url(); ?>assets/uploads/profiles/default.png">
			<h3><?php echo $this->session->userdata('username')?></h3> 
		 	<h3><a href="#" style="position: absolute;padding-top: 1%; right: 100px; " class="fa fa-facebook"></a></h3>
			<h3><a href="#" style="position: absolute;padding-top: 1%; right: 150px; " class="fa fa-twitter"></a></h3>
			<h3><a href="#" style="position: absolute;padding-top: 1%; right: 200px; " class="fa fa-instagram"></a></h3>
		</div>

			<!-- The Modal -->
			<div id="myModal1" class="modal1">
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
			</script>
		<div class="form-group" style="padding-bottom: 30px;">
			 <label class="col-md-3 control-label" for="name">Edit Username</label>  
			 <div class="col-md-9">
		  		<input id="id_form" name="id_form" type="text" class="form-control input-md" value="" enabled>
		  	 </div>
		</div>

		<div class="form-group" style="padding-bottom: 30px;">
			 <label class="col-md-3 control-label" for="name">Edit Password</label>  
			 <div class="col-md-9">
		  		<input id="id_form" name="id_form" type="text" class="form-control input-md" value="" enabled>
		  	 </div>
		</div>

		<div class="form-group" style="padding-bottom: 30px;">
			 <label class="col-md-3 control-label" for="name">Re-enter Password</label>  
			 <div class="col-md-9">
		  		<input id="id_form" name="id_form" type="text" class="form-control input-md" value="" enabled>
		  	 </div>
		</div>

		<div class="form-group" style="padding-bottom: 30px;">
			 <label class="col-md-3 control-label" for="name">Edit Email</label>  
			 <div class="col-md-9">
		  		<input id="id_form" name="id_form" type="text" class="form-control input-md" value="" enabled>
		  	 </div>
		</div>
		<div class="form-group">		
			<button type="button" onclick="showModalRequest()"	 class="btn btn-primary" name="btnRequest">Apply</button>
				<button type="button" onclick="showModalCancel()" class="btn btn-warning" name="btnCancel">Cancel</button>
			</div>
		</div>
			
		

			
</body>
</html>