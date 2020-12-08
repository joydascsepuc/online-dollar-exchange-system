<div class="container">
	<div class="p-5">
		<p class="font-weight-bold">Edit Investor</p>
		<form method="post" action="<?php echo base_url()?>admin/updateInvestor">
			<?php foreach($data as $value):?>
				<div class="row mt-5">
					<div class="col-md-4">
						<label for="name">Investor Name</label>
						<input type="text" name="name" value="<?=$value['name'];?>" class="form-control" required>
					</div>
					<div class="col-md-4">
						<label for="mobile">Mobile No</label>
						<input type="text" name="mobile" value="<?=$value['mobile'];?>" class="form-control" required>
					</div>
					<div class="col-md-4">
						<label for="percentage">Percentage</label>
						<input type="text" name="percentage" value="<?=$value['percentage'];?>" class="form-control" required>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-12">
						<label for="address">Address</label>
						<textarea class="form-control" name="address" style="height: 15rem;"><?=$value['address'];?></textarea>
					</div>
				</div>
				<input type="hidden" name="id" value="<?=$value['id'];?>">
			<?php endforeach;?>
			<div class="row mt-3">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-outline-primary btn-block">Update Investor</button>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
	</div>
</div>