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
    <!-- start slider -->
                <!-- START CAROUSEL SLIDESHOW -->
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="https://wallpapercave.com/wp/ykcroDx.jpg" alt="Los Angeles">
        </div>

        <div class="item">
          <img src="https://wallpapercave.com/wp/ykcroDx.jpg" alt="Chicago">
        </div>

        <div class="item">
          <img src="https://stmed.net/sites/default/files/kraken-wallpapers-28172-8649827.jpg" alt="New York">
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
                <!-- END CAROUSEL SLIDESHOW -->
        <!-- END CAROUSEL -->
  </div>
  

  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="loginmodal-container">
          <h1>Login</h1><br>
          <form method="POST" action="<?php echo base_url();?>index.php/VivliaController/authentication">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" id="key" placeholder="Password">

            <input id="box1" type="checkbox" onclick="showPassword()" />
              <label for="box1">Show Password</label>

            <input type="submit" name="login" class="login loginmodal-submit" value="Login">
          </form>
          
          <div class="login-help">
            <a href="#">Forgot Password</a>
          </div>
        </div>
      </div>
      </div>
</body>
<?php echo $js; ?>

<script type="text/javascript">
	 $(document).ready(function() {
        $('#loginModal').modal({
            backdrop: 'static',
            show: false,
            keyboard: true // to prevent closing with Esc button (if you want this too)
    	})
    });

	 function showModalLogin(){
		$('#loginModal').modal({
		    backdrop: 'static',
		    show: true,
		    keyboard: false  // to prevent closing with Esc button (if you want this too)
		});
	 }
  function showPassword() {
    
    var key_attr = $('#key').attr('type');
    
    if(key_attr != 'text') {
        
        $('.checkbox').addClass('show');
        $('#key').attr('type', 'text');
        
    } else {
        
        $('.checkbox').removeClass('show');
        $('#key').attr('type', 'password');
        
    }
  }
  
</script>
</html>