<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <div class="user-panel">
                  <div class="image">
                    <img src="<?php echo base_url(); ?>assets/img/coba.png" class="rounded-circle" alt="User Image">
                  </div>
                  <div class="info">
                    <p><?php echo $this->session->userdata('username');?></p>
                    <p><?php if($this->session->userdata('peran') == 1){
                            echo "Admin Pabrik";
                        } else if($this->session->userdata('peran') == 2){
                            echo "Manager Toko";
                        } else if ($this->session->userdata('peran') == 3) {
                            echo "Kasir Toko";
                        }?></p>
                    <a href="#" class="text-success"><i class="fa fa-circle text-success"></i> Online</a>
                  </div>
                </div>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php if($this->session->userdata('peran') == 1){
                            echo base_url().'index.php/dashboard';
                        } else if($this->session->userdata('peran') == 2){
                            echo base_url().'index.php/ManagerController/dashboard';
                        } else if ($this->session->userdata('peran') == 3) {
                            echo base_url().'index.php/CashierController/dashboard';
                        }?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <!-- <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts</span></a>
            </li> -->
            <li>
                <a href="<?php echo base_url(); ?>index.php/VivliaController/products"><i class="fa fa-table fa-fw"></i> Product List</a>
            </li>
            
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>