<div class="container">
	<div class="p-5">
		<?php echo form_open('auth/login');?>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<label for="mobile">Mobile No</label>
					<input type="text" name="mobile" class="form-control" placeholder="Ex : 01********" required>
					
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control" placeholder="" required>
				</div>
				<div class="col-md-3"></div>
			</div>
			<div class="row mt-5">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<button class="btn btn-outline-primary btn-block" type="submit">Login</button>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
	</div>
</div>