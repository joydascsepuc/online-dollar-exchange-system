<div class="container">
	<div class="p-5">
		<form method="post" action="<?=base_url()?>admin/updateCategory">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<?php foreach($data as $value):?>
						<label for="name">Category Name</label>
						<input type="text" name="name" value="<?=$value['name']?>" class="form-control" autocomplete="off" required>
						<input type="hidden" name="id" value="<?=$value['id'];?>">
					<?php endforeach;?>
					<div class="row mt-4">
						<div class="col-sm-4"></div>
						<div class="col-sm-4">
							<button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-outline-primary btn-block">Update</button>
						</div>
						<div class="col-sm-4"></div>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
	</div>
</div>