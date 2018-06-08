<!DOCTYPE html>
<html>
<head>
	<!DOCTYPE html>
	<?php echo $css; ?>


</head>
<body>
	<?php echo $header; ?>
	<?php echo $menuheader; ?>
	
	<!-- ini </nav> nya jangan dihapus yaa -->
  </nav>

  <div class="container"> 
  </div>
  <!-- start slider -->
  <div id="demo" class="carousel slide" data-ride="carousel">

	  <!-- Indicators -->
	  <ul class="carousel-indicators">
	    <li data-target="#demo" data-slide-to="0" class="active"></li>
	    <li data-target="#demo" data-slide-to="1"></li>
	    <li data-target="#demo" data-slide-to="2"></li>
	  </ul>
	  
	  <!-- The slideshow -->
	  <div class="carousel-inner">
	    <div class="carousel-item active">
	      <img src="http://i0.kym-cdn.com/photos/images/newsfeed/000/674/934/422.jpg" alt="Los Angeles" width="1100" height="500">
	    </div>
	    <div class="carousel-item">
	      <img src="http://i0.kym-cdn.com/photos/images/newsfeed/000/674/934/422.jpg" alt="Chicago" width="1100" height="500">
	    </div>
	    <div class="carousel-item">
	      <img src="http://i0.kym-cdn.com/photos/images/newsfeed/000/674/934/422.jpg" alt="New York" width="1100" height="500">
	    </div>
	  </div>
	  
	  <!-- Left and right controls -->
	  <a class="carousel-control-prev" href="#demo" data-slide="prev">
	    <span class="carousel-control-prev-icon"></span>
	  </a>
	  <a class="carousel-control-next" href="#demo" data-slide="next">
	    <span class="carousel-control-next-icon"></span>
	  </a>
	</div>
  <!-- End Slider -->

  <!-- Start Modal Login -->
  <div id="myModal" class="row modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                	<button type="button" class="close left" data-dismiss="modal">&times;</button>
                    <h1 class="modal-title">Login</h1>
                </div>
                <form class="form-horizontal" role="form" action="<?php echo base_url();?>index.php/VivliaController/authentication" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label class="control-label">Username</label>
                            </div>
                            <div class="col-sm-9">
                                <!-- NAME = email -->
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label class="control-label">Password</label>
                            </div>
                            <div class="col-sm-9">
                                <!-- NAME = password -->
                                <input type="text" name="password" class="form-control" placeholder="Password" >
                            </div>
                        </div>
                    </div>
                    <!-- SIGN IN -->
                    <div class="modal-footer">
                        <input type="submit" name="signIn" class="btn btn-primary" value="Login"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php echo $js; ?>
<script type="text/javascript">
	 $(document).ready(function() {
        $('#myModal').modal({
            backdrop: 'static',
            show: false,
            keyboard: true // to prevent closing with Esc button (if you want this too)
    	})
    });

	 function showModalLogin(){
		$('#myModal').modal({
		    backdrop: 'static',
		    show: true,
		    keyboard: false  // to prevent closing with Esc button (if you want this too)
		});
	}
</script>
</html>