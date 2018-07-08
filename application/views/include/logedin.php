<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="label label-pill label-danger count" style="border-radius:10px;"></span>
            <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-notif">
            <?php
            $i = 0;
            foreach ($list as $row) {
                if($i == 5) break;
                ?>
            <li style="margin-bottom: 20px;">
                <a href="<?php if($this->session->userdata('peran') == 1){ echo base_url('adm/notifications'); }
                else if($this->session->userdata('peran') == 2){ echo base_url('mgr/notifications'); } 
                else if($this->session->userdata('peran') == 3){ echo base_url('csh/notifications'); } ?>/<?php echo $row['id_notif']?>">
                    <div>
                        <i class="fa fa-comment fa-fw"></i><?php if($this->session->userdata('peran') == 1){ echo $row['nama_toko']; }
                        else{ echo $row['nama_penerbit']; } 
                        echo " had sent a notification"; 

                        $now = date('y-m-d H:i:s');
                        ?>
                        <span class="pull-right text-muted small">
                        <?php 
                        $diff_time = (strtotime($now) - strtotime($row['notif_time']))/(60*60*24);

                        if($diff_time > 365){
                        //  echo (strtotime(date('y-m-d')) - strtotime($row['tanggal']))/(60*60*24*365) . " years ";
                            echo floor($diff_time/365) . " years ";
                            $diff_time -= 365;
                        }
                        if($diff_time > 30){
                            echo floor($diff_time/30) . " months ";
                            $diff_time -= 30;
                        }
                        if($diff_time >= 1){
                            //echo (strtotime(date('y-m-d')) - strtotime($row['tanggal']))/(60*60*24) . " days ";
                            echo floor($diff_time) . " days ";
                            $diff_time -= floor($diff_time);
                        }
                        if($diff_time < 1){
                            //$diff_minute = (strtotime(date('H:i:s')) - strtotime($row['jam']))/(60);
                            $diff_time *= (24*60);
                            if($diff_time >= 60){
                                echo floor($diff_time/60) . " hours ";
                            }
                            else{
                                echo floor($diff_time) . " minutes ";
                            }
                        }
                        echo "ago\n";

                        ?>
                        </span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
                <?php
                $i++;
            }
            ?>
            
            <li>
                <a class="text-center" href="<?php if($this->session->userdata('peran') == 1){
                            echo base_url().'adm/notifications';
                        } else if($this->session->userdata('peran') == 2){
                            echo base_url().'mgr/notifications';
                        } else if ($this->session->userdata('peran') == 3) {
                            echo base_url().'csh/notifications';
                        }?>">
                    <strong>See All Notifications</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-alerts -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="<?php if($this->session->userdata('peran') == 1) echo base_url().'adm/editprofile';
                            else if($this->session->userdata('peran') == 2) echo base_url().'mgr/editprofile';
                            else if($this->session->userdata('peran') == 3) echo base_url().'csh/editprofile';
             ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url().'VivliaController/logout'; ?>"><i class="fa fa-sign-out fa-fw"></i> Sign out</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->