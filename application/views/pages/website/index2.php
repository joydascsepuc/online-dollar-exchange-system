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
          <div class="row mt-4 p-3">
            <!-- Send Portion -->
            <div class="col-md-6">
              <h5 class="bg-color">Send&nbsp;&nbsp;<i class="fas fa-paper-plane"></i></h5>
              <div class="row">
                <div class="col-4">
                  <img src="" alt="icon" id="img1" style="height: 35px; width: 35px;">
                </div>
                <div class="col-8">
                  <select id="send" class="form-control" onchange="sendChange(this.value);"  name="send" required>
                    <?php foreach ($maindata as $key => $value) :?>
                      <option selected value="<?=$value['id']?>"><?=$value['name'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              
              <input type="number" min="1" step="1" class="form-control mt-2" name="sendinputbox" id="sendinputbox" placeholder="Enter the Send Amount" onkeyup="calculation()" required>
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
              <div class="row">
                <div class="col-8">
                  <select id="receive" class="form-control" onchange="receiveChange(this.value);" name="receive" required>
                    
                    <?php foreach($maindata as $data):?>
                      <option selected value="<?=$data['id']?>"><?=$data['name'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="col-4">
                  <img src="" alt="icon" id="img2" style="height: 35px; width: 35px;">
                </div>
              </div>
              
              <input type="number" class="form-control mt-2" name="receiveinputbox" id="receiveinputbox" onkeyup="calculation()" readonly>
              <input type="hidden" name="receiveIsDollar" id="receiveIsDollar">
              <input type="hidden" name="receivebuyrate" id="receivebuyrate">
              <input type="hidden" name="receivesellrate" id="receivesellrate">
              <input type="hidden" name="receiveprocessingfee" id="receiveprocessingfee">
              <input type="hidden" name="receiveAvailable" id="receiveAvailable">
              <input type="hidden" name="receivePending" id="receivePending">
              <!-- Below part is for Calculation -->
              <input type="hidden" name="pfee2" id="pfee2">
            </div>
          </div>
          <!-- Processing Fee & Total Cost -->
          <div class="row mt-3 text-center" style="padding-left: 45px; padding-right: 65px;">
            <div class="col-12">
            	<div class="row">
                <div class="col-12">
                  <label id="sorryText" style="color: red;" class="font-weight-bold"></label>
                </div>
            		<div class="col-6" style="background-color: yellow; border-radius: 10px;">
            			<span class="font-weight-bold">Processing Fee: </span>
            		</div>
            		<div class="col-6 text-left">
            			<input type="text" class="custom form-control" name="processingFee" id="processingFee" readonly>
            		</div>
            	</div>
              	<div class="row mt-2">
              		<div class="col-6" style="background-color: #FF4500; border-radius: 10px;">
              			<span class="font-weight-bold">Total Cost: </span>
              		</div>
              		<div class="col-6 text-left">
              			<input type="text" class="custom form-control" name="totalCost" id="totalCost" readonly>
              		</div>
              	</div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <button type="submit" onclick="return confirm('Are you sure?')" id="submit" class="btn btn-block bg-color font-weight-bold">Accept</button>
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
                  <td><?=$data['name'];?></td>
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
                  <td><img src="<?=base_url() . $data['from_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td><?=$data['total_amount']?></td>
                   <td><img src="<?=base_url(). $data['to_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td>Pending</td>
                  <td><?=date('d/m/Y h:i a',$data['date'])?></td>
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
                  <td><img src="<?=base_url().$data['from_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td><?=$data['total_amount']?></td>
                  <td><img src="<?=base_url().$data['to_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td class="text-success">Completed</td>
                  <td><?=date('d/m/Y h:i a',$data['date'])?></td>
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
            <div class="col-md-6" id="indexAD1">
              <?php foreach ($advertise as $key => $value): ?>
                <?php if ($value['placement']=='indexAD1'): ?>
                  <?=$value['adlink']?>
                <?php endif ?>
              <?php endforeach ?>
            </div>
            <div class="col-md-6" id="indexAD2">
              <?php foreach ($advertise as $key => $value): ?>
                <?php if ($value['placement']=='indexAD2'): ?>
                  <?=$value['adlink']?>
                <?php endif ?>
              <?php endforeach ?>
            </div>
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
                  <td><img src="<?=base_url().$data['from_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td><?=$data['total_amount']?></td>
                  <td><img src="<?=base_url().$data['to_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td class="text-danger">Cancelled</td>
                  <td><?=date('d/m/Y h:i a',$data['date'])?></td>
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
                  <td><img src="<?=base_url().$data['icon']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
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
        <div class="p-3" id="indexAD3">
          <p>Ads</p>
          <?php foreach ($advertise as $key => $value): ?>
                <?php if ($value['placement']=='indexAD3'): ?>
                  <?=$value['adlink']?>
                <?php endif ?>
              <?php endforeach ?>
        </div>
  		</div>

  		<!-- User Reviews -->
  		<div class="mt-4 color responsive">
  			<h4 class="text-center font-weight-normal bg-color text-black"><i class="fas fa-users"></i>&nbsp;&nbsp;Users Reviews</h4>
        <div class="p-3 text-left">
          <?php foreach($reviews as $review):?>
            <h5 class="text-warning font-weight-bold"><?=$review['user_id']?></h5>
            <p class="text-white"><?=$review['review']?></p>
            <br>
          <?php endforeach;?>
        </div>
        <a href="<?php echo base_url()?>pages/allreviews" style="color:white">All Reviews</a>
  		</div>

  		<!-- Ads -->
  		<div class="mt-4 color">
  			<h4 class="text-center font-weight-normal bg-color text-black">Advertisements</h4>
        <div class="p-3" id="indexAD4">
          <p>Ads</p>
          <?php foreach ($advertise as $key => $value): ?>
                <?php if ($value['placement']=='indexAD4'): ?>
                  <?=$value['adlink']?>
                <?php endif ?>
              <?php endforeach ?>
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

<!-- EI BAL TA KAM KORE NA KEN DEKHIS TOH..JS HEDA AMR -->
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function(){

    var send = $('#send').val();

    $.ajax({
      url:base_url + 'admin/getSendData',
      type: "POST",
      data: {'sid' : send},
      dataType: 'json',
      success: function(data){
        var img = base_url+data.icon;
        document.getElementById("img1").src = img;
        $("#sendIsDollar").val(data.is_dollar);
        $("#sendbuyrate").val(data.buy_rate);
        $("#sendsellrate").val(data.sell_rate);
        $("#sendprocessingfee").val(data.processing_fee);
       

    },
  });

  var receive = $('#receive').val();
    $.ajax({
      url:base_url + 'admin/getReceiveData',
      type: "POST",
      data: {'rid' : receive},
      dataType: 'json',
      success: function(data){
        var img = base_url+data.icon;
        document.getElementById("img2").src = img;
        $("#receiveIsDollar").val(data.is_dollar);
        $("#receivebuyrate").val(data.buy_rate);
        $("#receivesellrate").val(data.sell_rate);
        $("#receiveprocessingfee").val(data.processing_fee);
        $("#receiveAvailable").val(data.available);
        $("#receivePending").val(data.pending);

    },
  });

    var sendIsDollar = $("#sendIsDollar").val();
    var rcvIsDollar = $("#receiveIsDollar").val();
    if(sendIsDollar ==0 && rcvIsDollar == 0){
      $('#submit').prop('disabled', true);
    }
     
  });


  function sendChange(id){
    
    $.ajax({
      url: base_url + 'pages/fetchMethodDataById/'+id,
      type: 'post',
      dataType: 'json',
      success:function(response){

        document.getElementById("img1").src = base_url+response.icon;
        $("#sendIsDollar").val(response.is_dollar);
        $("#sendbuyrate").val(response.buy_rate);
        $("#sendsellrate").val(response.sell_rate);
        $("#sendprocessingfee").val(response.processing_fee);
        calculation();
      }
    });
    //calculation();
  }

  function receiveChange(id){
    
    $.ajax({
       url: base_url + 'pages/fetchMethodDataById/'+id,
       type: 'post',
       dataType: 'json',
        success:function(response){
          document.getElementById("img2").src = base_url+response.icon;
          $("#receiveIsDollar").val(response.is_dollar);
          $("#receivebuyrate").val(response.buy_rate);
          $("#receivesellrate").val(response.sell_rate);
          $("#receiveprocessingfee").val(response.processing_fee);
          $("#receiveAvailable").val(response.available);
          $("#receivePending").val(data.pending);
          calculation();
        }
    });
    //calculation();
    
  }



  function calculation(){
    
    var sendIsDollar = $("#sendIsDollar").val();
    var rcvIsDollar = $("#receiveIsDollar").val();
    var buy_rate = $("#sendbuyrate").val();
    var sell_rate = $("#receivesellrate").val();
    var amount = $("#sendinputbox").val();
    var sendprocessingfee = $("#sendprocessingfee").val();
    var receiveprocessingfee = $("#receiveprocessingfee").val();

    var receiveAvailable = $('#receiveAvailable').val();
    var receivePending = $('#receivePending').val();
    // console.log(sendIsDollar);
    // console.log(rcvIsDollar);

    if(Number(sendIsDollar) == 1 && Number(rcvIsDollar) == 0){

      
      var total = buy_rate * amount;

      total = Math.floor(total);

      $('#receiveinputbox').val(total);
      $('#processingFee').val(0);
      $('#totalCost').val(amount);
      $('#pfee1').val(0);
      $('#pfee2').val(0);
      if(Number(receiveAvailable)<Number(total) || (Number(receiveAvailable)-Number(receivePending))<Number(total)){
        // sorryText.style.visibility='hidden';
        // sorryText.style.display='none';
        $('#sorryText').text('Sorry!!! We don\'t have this amount of money in reserve. ☹');
        $('#submit').prop('disabled', true);
      }
      else{
        $('#sorryText').text('');
        $('#submit').prop('disabled', false);
      }

    }

    else if(Number(sendIsDollar) == 0 && Number(rcvIsDollar) == 1){

      var total = (amount/sell_rate);
      var pfee1 = (sendprocessingfee * amount) / 100;
      var pfee2 = ((receiveprocessingfee * total) / 100) * sell_rate;
      var processingFee = Number(pfee1) + Number(pfee2);
      var totalcost = Number(amount) + Number(processingFee);

      total=total.toFixed(1);

      $('#receiveinputbox').val(total);
      $('#processingFee').val(processingFee.toFixed(1));
      $('#totalCost').val(Math.ceil(totalcost));
      $('#pfee1').val(pfee1);
      
      var dollarCal = ((receiveprocessingfee * total) / 100);
      $('#pfee2').val(dollarCal);
      if(Number(receiveAvailable)<Number(total) || (Number(receiveAvailable)-Number(receivePending))<Number(total)){
        // sorryText.style.visibility='hidden';
        // sorryText.style.display='none';
        $('#sorryText').text('Sorry!!! We don\'t have this amount of money in reserve. ☹');
        $('#submit').prop('disabled', true);
      }
      else{
        $('#sorryText').text('');
        $('#submit').prop('disabled', false);
      }
    }

    else if(Number(sendIsDollar) == 1 && Number(rcvIsDollar) == 1){
      
      var total = (buy_rate/sell_rate) * amount;
      var processingFee = ((receiveprocessingfee * total) / 100);
      var totalcost = Number(amount) + Number(processingFee);

      total=total.toFixed(1);

      $('#receiveinputbox').val(total);
      $('#processingFee').val(processingFee.toFixed(1));
      $('#totalCost').val(Math.ceiltotalcost);
      $('#pfee1').val(0);
      $('#pfee2').val(processingFee);

      if(Number(receiveAvailable)<Number(total) || (Number(receiveAvailable)-Number(receivePending))<Number(total)){
        // sorryText.style.visibility='hidden';
        // sorryText.style.display='none';
        $('#sorryText').text('Sorry!!! We don\'t have this amount of money in reserve. ☹');
        $('#submit').prop('disabled', true);
      }
      else{
        $('#sorryText').text('');
        $('#submit').prop('disabled', false);
      }
    }

    else{
      $('#receiveinputbox').val(amount);
      $('#submit').prop('disabled', true);
    }






  }



</script>