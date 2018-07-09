<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <div class="user-panel">
                  <div class="image">
                    <img style="border-radius:50%;max-width:100px;min-width: 100px;min-height: 100px; max-height:100px;" src="<?php echo base_url(); ?>assets/uploads/profiles/<?php if($this->session->userdata('foto') != NULL){ ?>default.png<?php } else{ echo $user['foto']; }?> ">
                  </div>
                  <div class="info">
                    <?php $iduser = $this->session->userdata('id_user'); ?>
                    <p><?php echo $user['username'];?></p>
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
                            echo base_url().'adm/dashboard';
                        } else if($this->session->userdata('peran') == 2){
                            echo base_url().'mgr/dashboard';
                        } else if ($this->session->userdata('peran') == 3) {
                            echo base_url().'csh/dashboard';
                        }?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <!-- <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts</span></a>
            </li> -->
            <li>
                <a href="<?php if($this->session->userdata('peran') == 1){
                            echo base_url().'adm/products';
                        } else if($this->session->userdata('peran') == 2){
                            echo base_url().'mgr/products';
                        } else if ($this->session->userdata('peran') == 3) {
                            echo base_url().'csh/products';
                        }?>"><i class="fa fa-table fa-fw"></i> Product List</a>
            </li>  
            <?php
                if($this->session->userdata('peran') == 2){
            ?>
            <li>
                <a href="<?php echo base_url().'mgr/request_products'; ?>"><i class="glyphicon glyphicon-th-list fa-fw"></i> Request Product</a>
            </li>
            <?php 
                }
            ?>
        </ul>
    </div>
</div>