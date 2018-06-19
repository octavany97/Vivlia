<div>
	<?php if($detail == NULL){ ?>
	<h3>
		Please choose the list in the left to see the notification detail!
	</h3>
	<?php } else { ?>
	<h3 style="border-bottom: 1px solid #eee;"><?php echo $detail['notif_subject']; ?></h3>
	<p style="border-bottom: 1px solid #eee;">
		<?php echo $detail['notif_msg']; ?>
		<?php 
		if($detail['flag'] == 0){
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
	<?php
	if($detail['flag'] == 0){
		?>
		<div style="text-align: center;">
			<button class="btn btn-success" style="min-width: 100px;">Yes</button>
			<button class="btn btn-danger" style="min-width: 100px;">No</button>
		</div>
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