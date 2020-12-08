<div class="container">
	<div class="p-5">
		<p class="text-center mb-4">To reset your password please enter your email and mobile number you've submitted.</p>
		<form method="post" action="<?=base_url()?>pages/resetPass">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<label for="mobile">Your Mobile Number</label>
					<input type="number" name="mobile" min="0" minlength="11" maxlength="11" class="form-control" autocomplete="off">

					<label for="email" class="mt-2">Your E-mail</label>
					<input type="email" name="email" class="form-control" autocomplete="off">

					<div class="row mt-4">
						<div class="col-md-1"></div>
						<div class="col-md-10">
							<button type="submit" class="btn btn-primary btn-block">Get Instructed</button>
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</form>
	</div>
</div>