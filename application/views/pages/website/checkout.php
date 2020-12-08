<div class="container">
	<div class="p-5">
		<p class="font-weight-bold" style="font-size: 1.1rem;">
		If you want to confirm your payment then please send expected money in the Wallet Address / Number which is shown in below.Afterthat,fill the down box with your payment wallet Address / Number (Which wallet address or Number used by you to make payment to us) and press confirm button.
		</p>
		<p class="mt-2 font-weight-bold" style="font-size: 1.1rem;">
			যদি আপনি আপনার পেমেন্ট টা সম্পন্ন করতে চান তবে আপনার কাঙ্কিত টাকার পরিমাণ নিচে উল্লেখিত ওয়ালেট এড্রেস বা বিকাশ নাম্বারে পাঠিয়ে যে ওয়ালেট বা নাম্বার হতে আপনি টাকা পাঠিয়েছেন, সেই ওয়ালেট এড্রেস বা নাম্বারটি একদম নিচের বক্সে লিখে "কনফার্ম" বাটনটি প্রেস করুন।
		</p>
	</div>
	<div class="row">
		<div class="col-md-3" id="checkoutADLeft">
			<p>Ads</p>
			<?php foreach ($advertise as $key => $value): ?>
                <?php if ($value['placement']=='checkoutADLeft'): ?>
                  <?=$value['adlink']?>
                <?php endif ?>
              <?php endforeach ?>
		</div>
		<div class="col-md-6">
			<p class="text-danger fort-weight-bold mb-3">Please fill this form carefully. Any misinformation will lead this tranx into late.</p>
			<form action="<?php echo base_url()?>pages/confirmation" method="post">
				
					<input type="hidden" name="sendId" value="<?=$inputs['sendId']?>">
					<input type="hidden" name="pfee1" value="<?=$inputs['pfee1']?>">
					<input type="hidden" name="pfee2" value="<?=$inputs['pfee2']?>">
					<label for="sendAmount">Send Amount</label>
					<input type="text" name="sendAmount" value="<?=$inputs['sendAmount']?>" class="form-control mb-2" readonly>

					<input type="hidden" name="receiveID" value="<?=$inputs['receiveID']?>">
					<label for="receiveAmount">Receive Amount</label>
					<input type="text" name="receiveAmount" value="<?=$inputs['receiveAmount']?>" class="form-control mb-2" readonly>

					<label for="processingFee">Processing Fee</label>
					<input type="text" name="processingFee" value="<?=$inputs['processingFee']?>" class="form-control mb-2" readonly>

					<label for="processingFee">Total Amount</label>
					<input type="text" name="totalAmount" value="<?=$inputs['totalAmount']?>" class="form-control mb-2" readonly>
					<br>

					<span style="font-size: 15pt" class="text-danger font-weight-bold">Pay to:</span> &nbsp;&nbsp;&nbsp;
					<?php foreach ($allAccounts as $key => $value):
						$methodName=""; ?>
						<?php if($selectedAccount['methodID'] == $value['id']){
							$methodName =  $value['name'];
							break;
						}?>
					<?php endforeach;?>
					<span class="text-danger" style="font-size: 20pt">Our <?=$methodName?> Address: <?=$selectedAccount['acNumber']?></span>
					<input type="hidden" name="from_method_account" id="from_method_account" value="<?=$selectedAccount['id']?>">
					<br>
					<br>
					<label for="processingFee">Your Send Wallet Number</label>
					<input type="text" name="sendWalletNumber" class="form-control mb-2" required>

					<label for="processingFee">Tranx Number</label>
					<input type="text" name="tranxNumber" class="form-control mb-2" required>

					<label for="processingFee">Your Receive Wallet Number</label>
					<input type="text" name="receiveWalletNumber" class="form-control mb-2" required>

					<div class="row mt-4">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<button class="btn btn-outline-primary btn-block" onclick="return confirm('Are You Sure? Once you placed you cannot chnage informations. Please Check twice.')" type="submit">Confirm Order</button>
						</div>
						<div class="col-md-2"></div>
					</div>

			</form>
		</div>
		<div class="col-md-3" id="checkoutADRight">
			<p>Ads</p>
			<?php foreach ($advertise as $key => $value): ?>
                <?php if ($value['placement']=='checkoutADRight'): ?>
                  <?=$value['adlink']?>
                <?php endif ?>
              <?php endforeach ?>
		</div>
	</div>
</div>