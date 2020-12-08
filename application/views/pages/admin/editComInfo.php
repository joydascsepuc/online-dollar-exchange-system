<div class="container">
	<div class="p-5">
		<form action="<?php echo base_url()?>admin/updateComInfo" method = "post">
			<?php foreach($info as $data):?>
				<div class="row">
					<div class="col-md-4">
						<label for="name">Company Name</label>
						<input type="text" name="name" class="form-control" value="<?=$data['name']?>" autocomplete="off">
					</div>
					<div class="col-md-4">
						<label for="mobile">Contact Number</label>
						<input type="number" name="mobile" class="form-control" value="<?=$data['mobile']?>" autocomplete="off">
					</div>
					<div class="col-md-4">
						<label for="name">Mailing Address</label>
						<input type="mail" name="mail" class="form-control" value="<?=$data['mail_address']?>" autocomplete="off">
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-md-6">
						<label for="name">Facebook Link</label>
						<input type="text" name="fblink" class="form-control" value="<?=$data['fb_link']?>" autocomplete="off">
					</div>
					<div class="col-md-6">
						<label for="name">Twitter Link</label>
						<input type="text" name="twlink" class="form-control" value="<?=$data['twitter_link']?>" autocomplete="off">
					</div>
				</div> 
				<div class="row mt-5">
					<div class="col-md-6">
						<label for="about">About Us</label>
						<textarea name="about" class="form-control" style="height: 15rem;"><?=$data['about']?></textarea>
					</div>
					<div class="col-md-6">
						<label for="name">Address</label>
						<textarea name="address" class="form-control" style="height: 15rem;"><?=$data['address']?></textarea>
					</div>
				</div>
			<?php endforeach;?>
			<div class="row mt-5">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-outline-primary btn-block">Update Information</button>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
	</div>
</div>