<div class="panel panel-blue">
    <div class="panel-heading">
        <i class="fa fa-clock-o fa-fw"></i> Latest Incoming Books
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <ul class="timeline">
            <?php
            $i = 0;
            //tampilin di timeline hanya 10 buku yang dikirim terbaru
            foreach ($histori as $row) {
                if($i == 10) break;
                if($i%2 == 0){
                    ?>
                    <li>
                    <?php
                }
                else{
                    ?>
                    <li class="timeline-inverted">
                    <?php
                }
                ?>
                    <div class="timeline-badge">
                        <img src="<?php echo base_url();?>assets/uploads/buku/<?php echo $row['cover']; ?>" class="timeline-picture">
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4 class="timeline-title"><?php echo $row['nama_buku']; ?> | <small style="font-size: 10pt;">Delivered by <?php echo $row['nama_penerbit']; ?> (Stock: <?php echo $row['stok']; ?>)</small></h4>
                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> 
                                <?php
                                $now = date('y-m-d H:i:s');

                                $diff_time = (strtotime($now) - strtotime($row['tanggal_kirim']))/(60*60*24);

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
                                // $diff_time = (strtotime($now) - strtotime($row['tanggal_kirim']))/(60*60*24);
                                // if($diff_time < 1){
                                //     $diff_minute = (strtotime(date('H:i:s')) - strtotime($row['jam']))/(60);

                                //     if($diff_minute < 60){
                                //         echo floor($diff_minute) . " minutes ago";    
                                //     }
                                //     else{
                                //         echo floor($diff_minute/60) . " hours ago";
                                //     }
                                // }
                                // else {
                                //     echo (strtotime(date('y-m-d')) - strtotime($row['tanggal']))/(60*60*24) . " days ago";
                                // }
                                ?>
                            </small></p>
                        </div>
                        <div class="timeline-body">
                            <p class="padding-bottom-10"><?php 
                            $num_char = 100;
                            $char = $row['keterangan']{strlen($row['keterangan']) - 1};
                            while($char != ' ') {
                                $char = $row['keterangan']{++$num_char};
                            }
                    
                            echo substr($row['keterangan'], 0, $num_char) . "..."; ?></p>

                            <small class="pull-right">by <?php echo $row['penulis']; ?></small>
                        </div>
                    </div>
                </li>
                <?php
                $i++;
            }
            ?>
        </ul>
    </div>
    <!-- /.panel-body -->
</div>
<!-- /.panel -->