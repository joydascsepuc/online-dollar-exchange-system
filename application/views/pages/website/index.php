<style type="text/css">
	.bg-color{
		background-color: #FFA500;
    padding: 10px;
	}

  .color{
    background-color: #486E7D;
  }
</style>

<div class="container text-center">
  <marquee behavior="scroll" direction="left" vspace ="20" scrollamount = "5" class = "font-weight-normal" style = "font-size: 1.2rem;"><?=$notices;?></marquee>
  <div class="row">

  	<!-- LEFT SIDE -->
  	<div class="col-md-8">
  		<!-- Exchange Here Section -->
  		<div style="background-color: #486E7D; padding-bottom: 20px;">
  			<h4 class="text-center text-black bg-color"><i class="fas fa-sync-alt"></i>&nbsp;&nbsp;Exchange Here</h4>
        <form action="<?php echo base_url()?>pages/checkout" method="post">
          <div class="row p-4 mt-4">
            <!-- Send Portion -->
            <div class="col-md-6">
              <h5 class="bg-color">Send&nbsp;&nbsp;<i class="fas fa-paper-plane"></i></h5>
              <select id="send" class="form-control" name="send" required>
                <option selected value="">Choose...</option>
                <?php foreach($maindata as $data):?>
                  <option value="<?=$data['id']?>" data-image = "<?=base_url();?>assets/images/methods/<?=$data['icon'];?>" data-imagecss="hw">
                    &nbsp;&nbsp;&nbsp;<?=$data['name'];?>  
                  </option>
                <?php endforeach;?>
              </select>
              <input type="number" class="form-control mt-2" name="sendinputbox" id="sendinputbox" value="1">
              <input type="hidden" name="sendIsDollar" id="sendIsDollar">
              <input type="hidden" name="sendbuyrate" id="sendbuyrate">
              <input type="hidden" name="sendsellrate" id="sendsellrate">
              <input type="hidden" name="sendprocessingfee" id="sendprocessingfee">
              <!-- Below part is for Calculation -->
              <input type="hidden" name="pfee1" id="pfee1">
            </div>

            <!-- Receive Portion -->
            <div class="col-md-6">
              <h5 class="bg-color">Receive&nbsp;&nbsp;<i class="fas fa-hand-holding-usd"></i></h5>
              <select id="receive" class="form-control" name="receive" required>
                <option selected value="">Choose...</option>
                <?php foreach($maindata as $data):?>
                  <option value="<?=$data['id']?>" data-image = "<?=base_url();?>assets/images/methods/<?=$data['icon'];?>" data-imagecss="hw">
                    &nbsp;&nbsp;&nbsp;<?=$data['name'];?>  
                  </option>
                <?php endforeach;?>
              </select>
              <input type="number" class="form-control mt-2" name="receiveinputbox" id="receiveinputbox" value="0" readonly>
              <input type="hidden" name="receiveIsDollar" id="receiveIsDollar">
              <input type="hidden" name="receivebuyrate" id="receivebuyrate">
              <input type="hidden" name="receivesellrate" id="receivesellrate">
              <input type="hidden" name="receiveprocessingfee" id="receiveprocessingfee">
              <!-- Below part is for Calculation -->
              <input type="hidden" name="pfee2" id="pfee2">
            </div>
          </div>
          <!-- Processing Fee & Total Cost -->
          <div class="row mt-3 text-center">
            <div class="col-12">
              <span class="font-weight-bold" style="background-color: yellow; border-radius: 10px; padding: 2px;">Processing Fee: </span> &nbsp;&nbsp;&nbsp;
              <input type="text" class="custom" name="processingFee" id="processingFee" readonly>
              <br>
              <span class="font-weight-bold" style="background-color: #FF4500; border-radius: 10px; padding: 2px;">Total Cost: </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" class="custom" name="totalCost" id="totalCost" readonly>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <button type="submit" id="submit" class="btn btn-block bg-color font-weight-bold">Accept</button>
            </div>
            <div class="col-md-4"></div>
          </div>
        </form>
  		</div>

  		<!-- Today's dollar rate -->
  		<div class="mt-4 color">
  			<h4 class="text-center font-weight-normal bg-color text-black"><i class="fas fa-search-dollar"></i>&nbsp;&nbsp;Today's Dollar Rate</h4>
  			<div class="p-3">
          <table class="table table-resonsive table-bordered text-black bg-white">
            <thead>
              <tr>
                <th>Currency</th>
                <th>Buy Rate</th>
                <th>Sell Rate</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($dollars as $data): ?>
                <tr>
                  <!-- <td><?=$data['name']?></td> -->
                  <td><img src="<?=base_url()?>assets/images/methods/<?=$data['icon']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td><?=$data['buy_rate']?></td>
                  <td><?=$data['sell_rate']?></td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>   
        </div>
  		</div>

  		<!-- Pending Exchange -->
  		<div class="mt-4 color">
  			<h4 class="text-center font-weight-normal bg-color text-black"><i class="fas fa-clock"></i>&nbsp;&nbsp;Pending Exchanges</h4>
        <div class="p-3">
          <table class="table table-resonsive table-bordered text-black bg-white">
            <thead>
              <tr>
                <th>Name</th>
                <th>From</th>
                <th>Amount</th>
                <th>To</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($pendingOrders as $data): ?>
                <tr>
                  <td><?=$data['user_id']?></td>
                  <td><img src="<?=base_url()?>assets/images/methods/<?=$data['from_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td><?=$data['total_amount']?></td>
                   <td><img src="<?=base_url()?>assets/images/methods/<?=$data['to_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td>Pending</td>
                  <td><?=$data['date']?></td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
  		</div>

  		<!-- Completed Exchange -->
  		<div class="mt-4 color">
  			<h4 class="text-center font-weight-normal bg-color text-black"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;Completed Exchanges</h4>
        <div class="p-3">
          <table class="table table-resonsive text-black bg-white table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>From</th>
                <th>Amount</th>
                <th>To</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($completedOrders as $data): ?>
                <tr>
                  <td><?=$data['user_id']?></td>
                  <td><img src="<?=base_url()?>assets/images/methods/<?=$data['from_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td><?=$data['total_amount']?></td>
                  <td><img src="<?=base_url()?>assets/images/methods/<?=$data['to_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td class="text-success">Completed</td>
                  <td><?=$data['date']?></td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
  		</div>

  		<!-- Ads -->
  		<div class="mt-4 color">
  			<h4 class="text-center font-weight-normal bg-color text-black">Advertisements</h4>
  			<div class="p-3">
          <div class="row text-center">
            <div class="col-md-6">Ad -1</div>
            <div class="col-md-6">Ad -2</div>
          </div>   
        </div>
  		</div>

  		<!-- Cancelled Exchange -->
  		<div class="mt-4 color">
  			<h4 class="text-center font-weight-normal bg-color text-black"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Canceled Exchanges</h4>
        <div class="p-3">
          <table class="table table-resonsive table-bordered text-black bg-white">
            <thead>
              <tr>
                <th>Name</th>
                <th>From</th>
                <th>Amount</th>
                <th>To</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($canceledOrders as $data): ?>
                <tr>
                  <td><?=$data['user_id']?></td>
                  <td><img src="<?=base_url()?>assets/images/methods/<?=$data['from_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td><?=$data['total_amount']?></td>
                  <td><img src="<?=base_url()?>assets/images/methods/<?=$data['to_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td class="text-danger">Cancelled</td>
                  <td><?=$data['date']?></td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
  		</div>
  	</div>

  	<!-- RIGHT SIDE -->
  	<div class="col-md-4">
  		
  		<!-- Reserve List -->
  		<div class="color">
  			<h4 class="text-center font-weight-normal bg-color text-black"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Reserve List</h4>
  			<div class="p-3">
          <table class="table table-resonsive table-bordered bg-white text-black">
            <thead>
              <tr>
                <th>Currency</th>
                <th>Symbol</th>
                <th>Reserve</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($maindata as $data): ?>
                <?php $reserve = 0; $reserve = $data['available'] - $data['pending'];?>
                <tr>
                  <td><?=$data['name']?></td>
                  <td><img src="<?=base_url()?>assets/images/methods/<?=$data['icon']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td><?=$reserve;?></td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>   
        </div>
  		</div>

  		<!-- Ads -->
  		<div class="mt-4 color">
  			<h4 class="text-center font-weight-normal bg-color text-black">Advertisements</h4>
        <div class="p-3">
          <p>Ads</p>
        </div>
  		</div>

  		<!-- User Reviews -->
  		<div class="mt-4 color responsive">
  			<h4 class="text-center font-weight-normal bg-color text-black"><i class="fas fa-users"></i>&nbsp;&nbsp;Users Reviews</h4>
        <div class="p-3">
          <?php foreach($reviews as $review):?>
            <h5><?=$review['user_id']?></h5>
            <p><?=$review['review']?></p>
            <br>
          <?php endforeach;?>
        </div>
        <a href="<?php echo base_url()?>pages/allreviews" style="color:white">All Reviews</a>
  		</div>

  		<!-- Ads -->
  		<div class="mt-4 color">
  			<h4 class="text-center font-weight-normal bg-color text-black">Advertisements</h4>
        <div class="p-3">
          <p>Ads</p>
        </div>
  		</div>

  		<!-- Total Members -->
  		<div class="mt-4 color">
  			<h4 class="text-center font-weight-normal bg-color text-black"><i class="fas fa-user-secret"></i>&nbsp;&nbsp;Total Members</h4>
        <p class="text-white font-weight-bold" style="font-size: 2rem;"><?=$totalmember;?></p>
  		</div>
  	</div>
  </div>

  <!-- TOTAL PENDING & LIFETIME COMPLETED -->
  <div class="row mt-5">
  	<div class="col-md-4">
  		<h5 class="bg-color display-5">Total Pending</h5>
  		<p class="text-black font-weight-bold" style="font-size: 2rem;"><?=$pendingNumber;?></p>
  		<a href="<?php echo base_url()?>pages/PendingHistory" style="color: black; font-size: 1.3rem;">See Full History</a>
  	</div>
  	<div class="col-md-4">
  		<h5 class="bg-color">Lifetime Completed</h5>
  		<p class="text-black font-weight-bold" style="font-size: 2rem;"><?=$completedNumber?></p>
  		<a href="<?php echo base_url()?>pages/CompletedHistory" style="color: black; font-size: 1.3rem;">See Full History</a>
  	</div>
  	<div class="col-md-4">
  		<h5 class="bg-color">Lifetime Canceled</h5>
  		<p class="text-black font-weight-bold" style="font-size: 2rem;"><?=$canceledNumber?></p>
  		<a href="<?php echo base_url()?>pages/CancelHistory" style="color: black; font-size: 1.3rem;">See Full History</a>
  	</div>
  </div>

</div>


<script type="text/javascript">
  
  $(document).ready(function(e) {
    try {
    $("select").msDropDown();
    } catch(e) {
    alert(e.message);
    }
    });

</script>

<script type="text/javascript">

    var base_url = "<?php echo base_url(); ?>";

    $(document).ready(function(){

      /*Send On chnage*/
      $('#send').on('change', function(){
          var sid = $(this).val();
          if(sid==""){
             $('#sendIsDollar').val("");
             $('#sendbuyrate').val("");
             $('#sendsellrate').val("");
             $('#sendprocessingfee').val("");
          }else{
            $.ajax({
                url:base_url + 'admin/getSendData',
                type: "POST",
                data: {'sid' : sid},
                dataType: 'json',
                success: function(data){
                   $('#sendIsDollar').val(data.is_dollar);
                   $('#sendbuyrate').val(data.buy_rate);
                   $('#sendsellrate').val(data.sell_rate);
                   $('#sendprocessingfee').val(data.processing_fee);
                },
            });
          }

          var sendIsDollar = $("#sendIsDollar").val();
          var rcvIsDollar = $("#receiveIsDollar").val();
          if(sendIsDollar == 0 && rcvIsDollar == 0){
            $('#submit').prop('disabled', true);
          }

        });

        /*Receive On Change*/
        $('#receive').on('change', function(){
          var rid = $(this).val();
          if(rid==""){
             $('#receiveIsDollar').val("");
             $('#receivebuyrate').val("");
             $('#receivesellrate').val("");
             $('#receiveprocessingfee').val("");
          }else{
            $.ajax({
                url:base_url + 'admin/getReceiveData',
                type: "POST",
                data: {'rid' : rid},
                dataType: 'json',
                success: function(data){
                   $('#receiveIsDollar').val(data.is_dollar);
                   $('#receivebuyrate').val(data.buy_rate);
                   $('#receivesellrate').val(data.sell_rate);
                   $('#receiveprocessingfee').val(data.processing_fee);
                },
            });
          }

        });
      });
</script>



<!-- EI BAL TA KAM KORE NA KEN DEKHIS TOH..JS HEDA AMR -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#receive, #send').on('change', function(){
        var sendIsDollar = $("#sendIsDollar").val();
        var rcvIsDollar = $("#receiveIsDollar").val();

        if(sendIsDollar == "0" && rcvIsDollar == "0"){
          $('#submit').prop('disabled', true);
        }
      });
  });
</script>




<!-- Calculation Part -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#sendinputbox').on('keyup', function(){
        var sendIsDollar = $("#sendIsDollar").val();
        var rcvIsDollar = $("#receiveIsDollar").val();

        if(sendIsDollar == 1 && rcvIsDollar == 0){
          var buy_rate = $("#sendbuyrate").val();
          var amount = $("#sendinputbox").val();
          var total = buy_rate * amount;
          $('#receiveinputbox').val(total);
          $('#processingFee').val("0");
          $('#totalCost').val(amount);
          $('#pfee1').val('0');
          $('#pfee2').val('0');
          $('#submit').prop('disabled', false);
        }else if(sendIsDollar == 0 && rcvIsDollar == 1){
          var sell_rate = $("#receivesellrate").val();
          var amount = $("#sendinputbox").val();
          var total = (amount/sell_rate);
          var sendprocessingfee = $("#sendprocessingfee").val();
          var receiveprocessingfee = $("#receiveprocessingfee").val();
          var pfee1 = (sendprocessingfee * amount) / 100;
          var pfee2 = ((receiveprocessingfee * total) / 100) * sell_rate;
          var processingFee = pfee1 + pfee2;
          var totalcost = +amount + +processingFee;
          $('#receiveinputbox').val(total);
          $('#processingFee').val(processingFee);
          $('#totalCost').val(totalcost);
          $('#pfee1').val(pfee1);
          var dollarCal = ((receiveprocessingfee * total) / 100);
          $('#pfee2').val(dollarCal);
          $('#submit').prop('disabled', false);
        }else if(sendIsDollar == 1 && rcvIsDollar == 1){
          var sendbuyrate = $("#sendbuyrate").val();
          var rcvsellrate = $("#receivesellrate").val();
          var amount = $("#sendinputbox").val();
          var total = (sendbuyrate/rcvsellrate) * amount;
          var receiveprocessingfee = $("#receiveprocessingfee").val();
          var processingFee = ((receiveprocessingfee * total) / 100);
          var totalcost = +amount + +processingFee;
          $('#receiveinputbox').val(total);
          $('#processingFee').val(processingFee);
          $('#totalCost').val(totalcost);
          $('#pfee1').val('0');
          $('#pfee2').val(processingFee);
          $('#submit').prop('disabled', false);
        }else{
          $('#submit').prop('disabled', true);
        }
    });
  });
</script>