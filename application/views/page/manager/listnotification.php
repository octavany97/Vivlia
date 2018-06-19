<div>
	<?php 
	foreach ($list as $row) {
		if($row['flag'] == 0){
		?>
		<div class="notif notif-waiting" onclick="showDetailManager(<?php echo $row['id_notif']; ?>)">
		<?php
		}
		else if($row['flag'] == 1){
		?>
		<div class="notif notif-accepted" onclick="showDetailManager(<?php echo $row['id_notif']; ?>)">
		<?php
		}
		else if($row['flag'] == 2){
		?>
		<div class="notif notif-rejected" onclick="showDetailManager(<?php echo $row['id_notif']; ?>)">
		<?php
		}
		?>
			<h4><?php echo $row['nama_penerbit'] . " had send a notification"; ?></h4>
			<?php echo "<br>"; ?>
			<h5>
			<?php 
			$now = date('y-m-d H:i:s');
	                                
	        $diff_time = (strtotime($now) - strtotime($row['notif_time']))/(60*60*24);

	        if($diff_time > 365){
	        //	echo (strtotime(date('y-m-d')) - strtotime($row['tanggal']))/(60*60*24*365) . " years ";
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
			</h5>	
		</div>
		
		
		<?php 
		echo "<br>";
	}
	?>
</div>