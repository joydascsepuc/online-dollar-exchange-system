<div class="container">
	<div class="p-5">
		<?php echo form_open_multipart('admin/updateMethod');?>
		<?php foreach($data as $value): ?>
			<input type="hidden" name="id" value="<?=$value['id']?>">

			<div class="row">
				<div class="col-md-3">
					<label for="name">Method Name</label>
					<input type="text" name="name" value="<?=$value['name']?>" class="form-control" autocomplete="off" required>
				</div>
				
				<div class="col-md-3">
					<label for="icon">Method's Icon</label>
					<input name="icon" type="file" size="20">
				</div>

				<div class="col-md-3">
					<label for="processingfee" class="mt-2">Processing Fee (In Percentage)</label>
					<input type="number" step="0.01" min="0" name="processingfee" value="<?=$value['processing_fee']?>" class="form-control" autocomplete="off" required>
				</div>
				<div class="col-md-3">
					<label for="isdollar" class="mt-2">Is Dollar?</label>
					<?php $option = $value['is_dollar']; ?>
					<select id="isdollar" class="form-control" name="isdollar" required>
						<option selected value="">Choose...</option>
						<option value="1" <?php if($option==1) echo 'selected'?> >Yes</option>
						<option value="0" <?php if($option==0) echo 'selected'?>>No</option>
					</select>
				</div>

				<div class="col-md-3">
					<label for="buy" class="mt-2">Today's Buy Rate</label>
					<input type="number" min="1" step="0.01" name="buyrate" value="<?=$value['buy_rate']?>" class="form-control" autocomplete="off" required>
				</div>

				<div class="col-md-3">
					<label for="sell" class="mt-2">Today's Sell Rate</label>
					<input type="number" min="1" step="0.01" name="sellrate" value="<?=$value['sell_rate']?>" class="form-control" autocomplete="off" required>
				</div>

				<div class="col-md-3">
					<label for="cashInAmountDaily" class="mt-2">Daily Cash In Amount</label>
					<input type="number" min="1" step="0.01" name="cashInAmountDaily" value="<?=$value['cashInAmountDaily']?>" class="form-control" autocomplete="off" required>
				</div>

				<div class="col-md-3">
					<label for="cashInCountDaily" class="mt-2">Daily Cash In Count</label>
					<input type="number" min="1" step="0.01" name="cashInCountDaily" class="form-control" value="<?=$value['cashInCountDaily']?>" autocomplete="off" required>
				</div>

				<div class="col-md-3">
					<label for="cashInAmountMonthly" class="mt-2">Monthly Cash In Amount</label>
					<input type="number" min="1" step="0.01" name="cashInAmountMonthly" class="form-control" value="<?=$value['cashInAmountMonthly']?>" autocomplete="off" required>
				</div>

				<div class="col-md-3">
					<label for="cashInCountMonthly" class="mt-2">Monthly Cash In Count</label>
					<input type="number" min="1" step="0.01" name="cashInCountMonthly" value="<?=$value['cashInCountMonthly']?>" class="form-control" autocomplete="off" required>
				</div>
			</div>
			<!-- <div class="row mt-5">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<label for="accnumber">Account Number</label>
					<input type="text" name="accnumber" value="<?=$value['acc_number']?>" class="form-control" autocomplete="off" required>

					

					

					

					
				</div>
				<div class="col-md-3"></div>
			</div> -->
		<?php endforeach;?>
			<div class="row mt-5 text-center">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-outline-primary btn-block">Update Method</button>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
	</div>
</div>