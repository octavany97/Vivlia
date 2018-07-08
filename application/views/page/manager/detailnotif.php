<div>
	<?php if($detail == NULL AND $this->uri->segment('3') == NULL){ ?>
	<h3>
		Please choose the list in the left to see the notification detail!
	</h3>
	<?php } else { ?>
	<h3 style="border-bottom: 1px solid #eee;"><?php echo $detail['notif_subject']; ?></h3>
	<div class="col-md-12">
		<div class="col-md-1">
			<img src="<?php echo base_url(); ?>assets/uploads/profiles/<?php if($detail['foto'] != NULL){ echo $detail['user1']; } else{ echo "default.png"; } ?>" class="rounded-circle" style="background-color: #e7e7e7; width: 50px; height: auto;" >	
		</div>
		<div class="col-md-8" id="info-notif" style="padding-left: 30px;">
			<strong><?php echo $detail['user1'] . " (" . $detail['nama_penerbit'] . ")"; ?></strong><br>
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
	<p style="border-bottom: 1px solid #eee; padding-top: 100px;">
		<?php echo $detail['notif_msg']; ?>
		<?php 
		if($detail['flag'] == 0 && $this->session->userdata('peran') == 2){
			?>
			<br><br>
			Notes:
			<br>
			<small style="color: #5cb85c;">If Yes, then you want to receive that book</small><br>
			<small style="color: #d9534f;">If No, then you don't want to receive that book or you want to request by form</small>
			<?php
		}

		?>
	</p>
	<br>
	<?php
	if($detail['flag'] == 0){
		if($this->session->userdata('peran') == 2){
			?>
			<div style="text-align: center;">
				<button class="btn btn-success" style="min-width: 100px;">Yes</button>
				<button class="btn btn-danger" style="min-width: 100px;">No</button>
			</div>
			<?php
		}
		else if($this->session->userdata('peran') == 3){
			?>
			<div style="text-align: center; color:red;">
				You don't have an access.
			</div>
			<?php
		}
		?>
		
		<?php
	}

	else if($detail['flag'] == 1){
		?>
		<div style="text-align: center; color: #5cb85c;">
			<p>You are accepted to send this book.</p>
		</div>
		<?php
	}
	else if($detail['flag'] == 2){
		?>
		<div style="text-align: center; color: #d9534f;">
			<p>You are rejected to send this book.</p>
		</div>
		<?php
	}
	?>
	
	<?php } ?>
</div>