<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
	<?php echo $css; ?>


</head>
<body>
	<?php echo $header; ?>
	<?php echo $menuheader; ?>
	
	<!-- ini </nav> nya jangan dihapus yaa -->
  </nav>

  <div class="container"> 
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">User Guide | <span style="font-size: 16pt;">Admin | Manager | Cashier </span></h1>
      </div>  
    </div>
    <!-- start slider -->
    <!-- START CAROUSEL SLIDESHOW -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?php echo base_url();?>assets/uploads/files/Welcome.png" alt="Los Angeles">
        </div>

        <div class="item">
          <img src="<?php echo base_url();?>assets/uploads/files/Admin.png" alt="Chicago">
        </div>

        <div class="item">
          <img src="<?php echo base_url();?>assets/uploads/files/manager.png" alt="New York">
        </div>

        <div class="item">
          <img src="<?php echo base_url();?>assets/uploads/files/cashier.png" alt="New York">
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
          <?php 
            if($this->session->has_userdata('error_login')){
              echo "<span style=\"color:red;\">Username or Password Invalid</span>";
            }
          ?>
          <form method="POST" action="<?php echo base_url();?>index.php/VivliaController/authentication">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" id="key" placeholder="Password" required>

            <input id="box1" type="checkbox" onclick="showPassword()" />
              <label for="box1">Show Password</label>

            <input type="submit" name="login" class="login loginmodal-submit" value="Login">
          </form>
      </div>
    </div>
  </div>
</body>
<?php echo $js;
    
 ?>

<script type="text/javascript">
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
<?php
  if($this->session->has_userdata('error_login')){
    echo '<script type="text/javascript">',
          'showModalLogin();',
          '</script>';
    unset($_SESSION['error_login']);
  }
?>
</html>