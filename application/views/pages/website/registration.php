<div class="container align-middle">
	<h5 class="display-5 text-center mt-4">Sign Up to join our family</h5>
	<form method="post" action="<?php echo base_url()?>auth/register">
		<div class="row">
			<div class="col-md-3" id="regADLeft">
				<?php foreach ($advertise as $key => $value): ?>
                <?php if ($value['placement']=='regADLeft'): ?>
                  <?=$value['adlink']?>
                <?php endif ?>
              <?php endforeach ?>

			</div>
			<div class="col-md-6">
				<label for="name">Name *</label>
				<input type="text" name="name" autocomplete="off" class="form-control" placeholder="Ex : John Doe" required>
				<label for="email" class="mt-3">E-mail address *</label>
				<input type="email" name="email" id="email" aria-describedby="emailHelp" autocomplete="off" class="form-control" placeholder="Ex : johhdoe@mail.com" required>
				<small id="emailHelp" class="form-text text-muted">Must be needed to recover your password.</small>
				<span id="mail_result"></span>
				
				<div class="row mt-3">
					<div class="col-sm-6">
						<label for="mobile">Mobile No *</label>
						<input type="text" pattern="\d*" name="mobile" id="mobile" minlength="11" maxlength="11" autocomplete="off" class="form-control" placeholder="Ex : 01*********" required>
						<span id="mobile_result"></span>
					</div>
					<div class="col-sm-6">
						<label for="gender">Gender *</label>
						<select id="gender" class="form-control" name="gender" required>
					       <!-- <option selected value="">Choose...</option> -->
					       <?php foreach($genders as $gender): ?>
					       	<option value="<?=$gender['id']?>"><?=$gender['name'];?></option>
					       <?php endforeach; ?>
					    </select>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-sm-6">
						<label for="password">Password *</label>
						<input type="password" minlength="8" name="password" id="password" class="form-control" autocomplete="off" required >
					</div>
					<div class="col-sm-6">
						<label for="conpassword">Confirm Password *</label>
						<input type="password" name="conpassword" id="conpassword" class="form-control" autocomplete="off" required>
						<span id='message'></span>
					</div>
				</div>
					<label for="address">Address</label>
					<textarea class="form-control" name="address" style="height: 10rem;"></textarea>
					<div class="row mt-4">
					<div class="col-md-3"></div>
					<div class="col-md-6">
					<button class="btn btn-outline-primary btn-block" id="register" type="submit" style="padding: .1rem .75rem;">Sign Up</button>
					</div>
					<div class="col-md-3"></div>
				</div>
			</div>

			<div class="col-md-3" id="regADRight">
				<?php foreach ($advertise as $key => $value): ?>
                <?php if ($value['placement']=='regADRight'): ?>
                  <?=$value['adlink']?>
                <?php endif ?>
              <?php endforeach ?>

			</div>
		</div>
	</form>
</div>


<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
	$(document).ready(function() {
    
    $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});


	$('#password, #conpassword').on('keyup', function () {
		if ($('#password').val() == $('#conpassword').val()) {
		  $('#message').html('Matched').css('color', 'green');
		  document.getElementById("register").disabled = false;
		}else {
		  $('#message').html('Not Matched').css('color', 'red');
		  document.getElementById("register").disabled = true;
		}
	});


	$('#email').on('keyup',function(){  
       var email = $('#email').val();  
       if(email != ''){  
          $.ajax({  
           url:"<?php echo base_url(); ?>auth/check_mail_avalibility",  
           method:"POST",  
           data:{email:email},  
           success:function(data){  
              $('#mail_result').html(data);
              var check = $("#mail_result").text();                        
              if(check == "Email Already Registered"){
                $('#register').prop('disabled', true);
               }else{
                $('#register').prop('disabled', false);
              }                         
            }  
        });  
      }  
  });




	$('#mobile').on('keyup',function(){  
       var email = $('#mobile').val();  
       if(email != ''){  
          $.ajax({  
           url:"<?php echo base_url(); ?>auth/check_mobile_avalibility",  
           method:"POST",  
           data:{email:email},  
           success:function(data){  
              $('#mobile_result').html(data);
              var check = $("#mobile_result").text();                        
              if(check == "Mobile Already Registered"){
                $('#register').prop('disabled', true);
               }else{
                $('#register').prop('disabled', false);
              }                         
            }  
        });  
      }  
  }); 
</script>