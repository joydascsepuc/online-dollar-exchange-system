<div class="container p-5">
	<?php echo form_open_multipart('auth/updateProfile');?>
		<?php foreach($data as $value): ?>
			<div class="row">
				<div class="col-md-4">
					<label for="name">Name</label>
					<input type="text" name="name" value="<?=$value['name']?>" class="form-control" autocomplete="off" required>
				</div>
				<div class="col-md-4">
					<label for="email">Email</label>
					<input type="text" name="email" value="<?=$value['email']?>" class="form-control" readonly>
					<span>Not Changeable.!!</span>
				</div>
				<div class="col-md-4">
					<label for="mobile">Mobile</label>
					<input type="text" name="mobile" value="<?=$value['mobile']?>" class="form-control" autocomplete="off" readonly>
					<span>Not Changeable.!!</span>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-md-4">
					<label for="gender">Gender *</label>
					<?php $g = $value['gender']; ?>
					<select id="gender" class="form-control" name="gender" required>
				       <option selected value="">Choose...</option>
				       <?php foreach($genders as $gender): ?>
				       	<option value="<?=$gender['id']?>" <?php if($gender['id']==$g) echo 'selected'?> ><?=$gender['name'];?></option>
				       <?php endforeach; ?>
				    </select>
				</div>
				<div class="col-md-4">
					<label for="password">Password</label>
					<input type="password" minlength="8" id="profilepassword" name="password" class="form-control" autocomplete="off" required>
				</div>
				<div class="col-md-4">
					<label for="confirmpassword">Confirm Password</label>
					<input type="password" id="profileconfirmpassword" name="confirmpassword" class="form-control" autocomplete="off" required>
					<span id="profilemessage"></span>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-12">
					<label for="address">Address</label>

					<textarea class="form-control" name="address" style="height: 15rem;"><?=$value['address']?></textarea>
				</div>
			</div>
			<input type="hidden" name="id" value="<?=$value['id']?>">
		<?php endforeach;?>
		<div class="row mt-5">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<button class="btn btn-outline-primary btn-block" id="profileSubmit">Save Changes</button>
			</div>
			<div class="col-md-4"></div>
		</div>
	</form>
</div>


<script type="text/javascript">
	$('#profilepassword, #profileconfirmpassword').on('keyup', function () {
	    if ($('#profilepassword').val() == $('#profileconfirmpassword').val()) {
	      $('#profilemessage').html('Matched').css('color', 'green');
	      document.getElementById("profileSubmit").disabled = false;
	    } else {
	      $('#profilemessage').html('Not Matched').css('color', 'red');
	      document.getElementById("profileSubmit").disabled = true;
	    }
	});
</script>