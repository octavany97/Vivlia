<div>
	<?php if($detail == NULL AND $segment == NULL){ ?>
	<h3>
		Please choose the list in the left to see the notification detail!
	</h3>
	<?php } else { ?>
	<h3 style="border-bottom: 1px solid #eee;"><?php echo $detail['notif_subject']; ?></h3>
	<div class="col-md-12">
		<div class="col-md-1">
			<img src="<?php echo base_url(); ?>assets/uploads/profiles/<?php if($detail['foto'] != NULL){ echo $detail['foto']; } else{ echo "default.png"; } ?>" class="rounded-circle" style="background-color: #e7e7e7; width: 50px; height: auto;" >	
		</div>
		<div class="col-md-8" id="info-notif" style="padding-left: 30px;">
			<strong><?php echo $detail['user1'] . " (" . $detail['nama_toko'] . ")"; ?></strong><br>
			<strong>to me</strong><br>
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
	            <span style="color: blue;">details</span> <button class="btn btn-default btn-xs fa fa-caret-down"></button>
	        </a>
			<ul class="dropdown-menu">
				<li><span class="col-md-2">from: </span><span class="col-md-6"><?php echo $detail['email1']; ?></span></li><br>
				<li><span class="col-md-2">to: </span><span class="col-md-6"><?php echo $detail['email2']; ?></span></li><br>
				<li><span class="col-md-2">date: </span><span class="col-md-6"><?php echo $detail['notif_time']; ?></span></li><br>
				<li><span class="col-md-2">subject: </span><span class="col-md-6"><?php echo $detail['notif_subject']; ?></span></li>
			</ul>
				
		</div>
		<div class="col-md-3">
			<span><?php echo $detail['tanggal']; ?></span>
		</div>

	</div>

	<p style="border-bottom: 1px solid #eee; margin-top: 100px;">
		<?php echo $detail['notif_msg']; ?>
		<?php 
		if($detail['flag'] == 0){
			?>
			<br><br>
			Notes:
			<br>
			<small style="color: #5cb85c;">If Send, then you want to send that book</small><br>
			<small style="color: #d9534f;">If Confirm, then you are asking to the store</small>
			<?php
		}
		?>
	</p>
	<br>
	<?php
	//ketika belum baca atau belum mencet button sama sekali
	if($detail['flag'] == 0 ){
		?>
		<div style="text-align: center;">
			<button class="btn btn-success" onclick="changeFlagAdmin(1, <?php echo $detail['id_notif']; ?>)" style="min-width: 100px;">Send Book</button>
			<button class="btn btn-warning" onclick="changeFlagAdmin(2, <?php echo $detail['id_notif']; ?>)" style="min-width: 100px;">Confirm to Store</button>
		</div>
		<?php
	}
	//ketika diterima sama tokonya
	else if($detail['flag'] == 1){
		?>
		<div style="text-align: center; color: #5cb85c;">
			<p>You had already choosen to send this book.</p>
		</div>
		<?php
	}
	//ketika confirm dlu ke tokonya
	else if($detail['flag'] == 2){
		?>
		<div style="text-align: center; color: #f0ad4e;">
			<p>You are asking to the store.</p>
			<button class="btn btn-success" onclick="changeFlagAdmin(1, <?php echo $detail['id_notif']; ?>)" style="min-width: 100px;">Send Book</button>
		</div>
		<?php
	}
	//ketika ditolak
	else if($detail['flag'] == 3){
		?>
		<div style="text-align: center; color: #d9534f;">
			<p>This request had been rejected.</p>
		</div>
		<?php
	}
	?>
	
	<?php } ?>
</div>
