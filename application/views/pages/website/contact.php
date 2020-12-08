<div class="container-fluid">
	<h5 class="display-5 text-center mt-4">Mail us for any query</h5>
	<div class="row">
		<div class="col-md-3"  id="contactADLeft">
			<p>Ads</p>
			<?php foreach ($advertise as $key => $value): ?>
                <?php if ($value['placement']=='contactADLeft'): ?>
                  <?=$value['adlink']?>
                <?php endif ?>
              <?php endforeach ?>
		</div>
		<div class="col-md-6">
			<form style="margin-top: 1rem;" action="<?php echo base_url()?>pages/sendMail" method="post">
				<input type="text" name="name" autocomplete="off" placeholder="Full Name" class="form-control" required>
				<br>
				<input type="mail" name="mail" placeholder="Mail Address" autocomplete="off" class="form-control" required>
				<br>
				<input type="text" name="subject" placeholder="Subject" autocomplete="off" class="form-control" required>
				<br>
				<textarea class="form-control" name="message" placeholder="Write Down Your Message Here..." style="height: 20rem;" required></textarea>

				<div class="row mt-4">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
						<button class="btn btn-outline-primary btn-block font-weight-bold" type="submit">Send Message</button>
					</div>
					<div class="col-sm-2"></div>
				</div>
			</form>
		</div>
		<div class="col-md-3"  id="contactADRight">
			<p>Ads</p>
			<?php foreach ($advertise as $key => $value): ?>
                <?php if ($value['placement']=='contactADRight'): ?>
                  <?=$value['adlink']?>
                <?php endif ?>
              <?php endforeach ?>
		</div>
	</div>
</div>