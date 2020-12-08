<div class="container">
	<div class="p-5">
		<p class="font-weight-bold">Add Expense</p>
		<form method="post" action="<?php echo base_url();?>admin/updateExpense">
			<?php foreach($data as $value):?>
				<div class="row mt-5">
					<div class="col-md-4">
						<label for="expenseDate">Date of Expense</label>
						<input type="date" value="<?=$value['expense_date']?>" name="expenseDate" id="expenseDate" class="form-control" autocomplete="off" required>
					</div>
					<div class="col-md-4">
						<?php $id = $value['category'];?>
						<label for="category">Category *</label>
						<select id="category" class="form-control" name="category" required>
					       <option selected value="">Choose...</option>
					       <?php foreach($categories as $category): ?>
					       	<option value="<?=$category['id']?>" <?php if($id == $category['id']) echo "Selected"?> ><?=$category['name'];?></option>
					       <?php endforeach; ?>
					    </select>
					</div>
					<div class="col-md-4">
						<label for="amount">Amount</label>
						<input type="number" value="<?=$value['amount']?>" min="0" name="amount" class="form-control" required>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-12">
						<label for="purpose">Additional Comment</label>
						<textarea class="form-control" name="purpose" style="height: 15rem;"><?=$value['additional_comment']?></textarea>
					</div>
				</div>
				<input type="hidden" name="id" value="<?=$value['id']?>">
			<?php endforeach;?>
			<div class="row mt-3">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-outline-danger btn-block">Update Expense</button>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
	</div>
</div>