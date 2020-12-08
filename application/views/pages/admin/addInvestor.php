<div class="container">
	<div class="p-5">
		<p class="font-weight-bold">Add Investor</p>
		<form method="post" action="<?php echo base_url()?>admin/addInvestor">
			<div class="row mt-5">
				<div class="col-md-4">
					<label for="name">Investor Name</label>
					<input type="text" name="name" class="form-control" required>
				</div>
				<div class="col-md-4">
					<label for="mobile">Mobile No</label>
					<input type="text" name="mobile" class="form-control" required>
				</div>
				<div class="col-md-4">
					<label for="percentage">Percentage</label>
					<input type="text" name="percentage" class="form-control" required>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-12">
					<label for="address">Address</label>
					<textarea class="form-control" name="address" style="height: 15rem;"></textarea>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-outline-primary btn-block">Add Investor</button>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
	</div>
</div>