<div class="container">
	<div class="p-5">
		<p class="font-weight-bold">Add Investment</p>
		<form method="post" action="<?php echo base_url();?>admin/invest">
			<div class="row mt-5">
				<div class="col-md-4">
					<label for="investDate">Date of Investment</label>
					<input type="text" name="investDate" id="investDate" class="form-control" autocomplete="off" required>
				</div>
				<div class="col-md-4">
					<label for="investorID">Investor *</label>
					<select id="investorID" class="form-control" name="investorID" required>
				       <option selected value="">Choose...</option>
				       <?php foreach($investors as $investor): ?>
				       	<option value="<?=$investor['id']?>"><?=$investor['name'];?>&nbsp;---&nbsp;<?=$investor['mobile'];?></option>
				       <?php endforeach; ?>
				    </select>
				</div>
				<div class="col-md-4">
					<label for="amount">Amount</label>
					<input type="number" min="1" name="amount" class="form-control" required>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-12">
					<label for="purpose">Amount Purpose</label>
					<textarea class="form-control" name="purpose" style="height: 15rem;"></textarea>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<button type="submit" onclick="return confirm('Are You Sure?')" class="btn btn-outline-primary btn-block">Add Data</button>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	 $("#investDate").datepicker({
		 format: "dd-mm-yyyy",
		    autoclose: true

		});
</script>