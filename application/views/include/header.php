<?php
    date_default_timezone_set('Asia/Jakarta');
?>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top blue-theme" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php if($this->session->userdata('peran') == 1){
                            echo base_url().'adm/dashboard';
                        } else if($this->session->userdata('peran') == 2){
                            echo base_url().'mgr/dashboard';
                        } else if ($this->session->userdata('peran') == 3) {
                            echo base_url().'csh/dashboard';
                        }?>"><img id="logo" src="<?php echo base_url(); ?>assets/img/logo/LogoVivlia.png"></a>
            </div>
            <!-- /.navbar-header -->         
            <!-- /.navbar-static-side -->
        <!-- </nav> -->