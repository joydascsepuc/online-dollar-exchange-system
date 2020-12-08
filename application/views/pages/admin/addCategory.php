<div class="container">
	<div class="p-5">
		<form method="post" action="<?=base_url()?>admin/addCategory">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<label for="name">Category Name</label>
					<input type="text" name="name" class="form-control" autocomplete="off" required>
					<div class="row mt-4">
						<div class="col-sm-4"></div>
						<div class="col-sm-4">
							<button type="submit" class="btn btn-outline-primary btn-block" onclick="return confirm('Are You Sure?')">Add</button>
						</div>
						<div class="col-sm-4"></div>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
	</div>
</div>