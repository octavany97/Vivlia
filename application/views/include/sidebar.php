<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        
            
        <ul class="nav" id="side-menu">
            <li>
                <div class="user-panel">
                  <div class="image">
                    <img src="<?php echo base_url(); ?>assets/img/coba.png" class="rounded-circle" alt="User Image">
                  </div>
                  <div class="info">
                    <p>Anthony</p>
                    <p>Admin Pabrik</p>
                    <!-- ntar diganti sama yg ini -->
                    <!-- <p><?php echo $res['username']; ?></p>
                    <p><?php echo $res['peran']; ?></p> -->
                    <a href="#" class="text-success"><i class="fa fa-circle text-success"></i> Online</a>
                  </div>
                </div>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/VivliaController/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="flot.html">Flot Charts</a>
                    </li>
                    <li>
                        <a href="morris.html">Morris.js Charts</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
            </li>
            
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>