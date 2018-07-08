<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php echo $css; ?>
	<?php echo $js; ?>
</head>
<body onload="load_unseen_notification_admin()">
	<?php echo $header; ?>
	<?php echo $menuheader; ?>
	<?php echo $sidebar; ?>
	</nav>
	<div id="page-wrapper">

		<div class="container">
		  <img  style="width: 1200px; height: 450px; background-size: contain;  background-position: center;  position: relative; background-color: skyblue;" >
			<div class="centered">
				<img id="pc01" style="max-width:200px;min-width: 50px;min-height: 50px; max-height:200px;" src="<?php echo base_url(); ?>assets/uploads/profiles/<?php if($this->session->userdata('foto') != NULL){ ?>default.png<?php } else{ echo $user['foto']; } ?>">
				<h3><?php echo $user['username'];?></h3> 
				<h3><a onclick="showModalLogin()" data-target="#myModal" data-toggle="modal" href="#" class="material-icons">&#xe7fa;</a></h3>
			</div>
		</div>


			<form id="formprofile" method="post" action="<?php echo base_url();?>/AdminController/confirmProfile">
				<div class="form-group" style="padding-bottom: 30px;padding-top: 30px;">
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
				  		<input id="id_form4" name="id_form4" type="text" class="form-control input-md" value="<?php echo $user['nama_toko']?>" readonly>
				  	 </div>
				</div>

				<div class="form-group" style="padding-bottom: 30px;">
					 <label class="col-md-3 control-label" for="name">IP address</label>  
					 <div class="col-md-9">
				  		<input id="id_form5" name="id_form5" type="text" class="form-control input-md" value="<?php echo $user['ip_addr']?>" readonly>
				  	 </div>
				</div>

				<div class="form-group" id="btn-area">		
					<button type="button" onclick="removeAlignment()" id="btnedit" class="btn btn-primary" name="btnedit">Edit</button>
		<!-- 				<button type="button"  class="btn btn-warning" name="btnCancel">Cancel</button> -->
					</div>
			</form>
	
	</div>
			
	<!-- Modal -->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; ">
    <div class="modal-dialog" >
      <div class="loginmodal-container">
          <h1>Ganti Foto</h1><br>
          <form id="formFoto" method="post" action="<?php echo base_url();?>/AdminController/editFoto" enctype="multipart/form-data">
          	 <div class="form-group">
	            <div class="col-sm-2">
	              <label class="control-label pull-right">Poster</label>
	            </div>
            <div class="col-sm-12">
              <input id="poster" type="file" class="form-control" name="poster">
              <label style="color: red;"></label>
            </div>
            <div class="form-group" id="btn-area" style="text-align: center; width: 100%;">		
					<button type="submit"  name="btnApply" class="btn btn-primary" >Apply</button>	
         	</div>
          </form>
      </div>
    </div>
  </div>



		
<?php echo $script;?>
<script>
	  function removeAlignment(){
   		 var read1 = document.getElementById("id_form1").removeAttribute("readonly",0);
   		 // var read2 = document.getElementById("id_form2").removeAttribute("readonly",0);
   		 var read3 = document.getElementById("id_form3").removeAttribute("readonly",0);
   		 // var read4 = document.getElementById("id_form4").removeAttribute("readonly",0);
  		 var read5 = document.getElementById("id_form5").removeAttribute("readonly",0);
  		 document.getElementById('btn-area').innerHTML = '';
  		 document.getElementById('btn-area').innerHTML = '<button type="submit"  id="btnsave" class="btn btn-primary" name="btnsave">Apply</button> <button type="button" onclick="cancel()"  class="btn btn-danger" name="btnCancel">Cancel</button></div>';
  		 console.log("btn edit")
  	  }
  	  function cancel(){
  	  	 var read1 = document.getElementById("id_form1").setAttribute("readonly",1);
   		 // var read2 = document.getElementById("id_form2").removeAttribute("readonly",0);
   		 var read3 = document.getElementById("id_form3").setAttribute("readonly",1);
   		 // var read4 = document.getElementById("id_form4").setAttribute("readonly",1);
  		 var read5 = document.getElementById("id_form5").setAttribute("readonly",1);
  		 document.getElementById('btn-area').innerHTML = '';
  		 document.getElementById('btn-area').innerHTML = '<button type="button" onclick="removeAlignment()" id="btnedit" class="btn btn-primary" name="btnedit">Edit</button>';
  		 console.log("btn cancel")
  	  }	
  	  // function apply(){
  	  // 	var read`
  	  // }
  	  	function showModalLogin(){
			$('#loginModal').modal({
			    backdrop: 'false',
			    show: true,
			    keyboard: true  // to prevent closing with Esc button (if you want this too)
			});
		    <?php
		      $idx = 2;
		    ?>
		 }
		
  	</script>			

</body>
</html>