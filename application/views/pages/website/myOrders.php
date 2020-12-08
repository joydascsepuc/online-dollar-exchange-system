<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
 <script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">


<div class="container-fluid">
	<div class="mt-4">
		<?php foreach($name as $data){
			$hello = $data['name'];
		}?>
		<p class="text-center">Hello <span class="font-weight-bold text-danger"><?=$hello?>,</span> Welcome to your order page.</p>
	</div>
	<div class="row">
		<div class="col-md-3">
			<p>Ads</p>
		</div>
		<div class="col-md-6">
			<div class="p-1">
				<h5 class="font-weight-bold mb-1 mt-2">Your Tranxs:</h5>
				<p class="font-weight-bold mb-1">Please Give us an review from below. Thank you for using our service.</p>
				<table class="table text-center" id="dataTable">
					<thead>
						<tr>
							<!-- <th>Name</th> -->
							<th>Invoice</th>
							<th>From</th>
							<th>Amount Given</th>
							<th>To</th>
							<!-- <th>Processing Fee</th> -->
							<th>Amount Received</th>
							<th>Status</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($myorders as $data):?>
							<tr>
								<!-- <td><?=$data['user_id'];?></td> -->
								<td><a target="_blank" href="<?=base_url()?>pages/details/<?=$data['id']?>"><?=$data['invoice'];?></a></td>
								<td><img src="<?=base_url().$data['from_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
								<td><?=$data['amount_give'];?></td>
								<td><img src="<?=base_url().$data['to_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
								<!-- <td><?=$data['processing_fee'];?></td> -->
								<td><?=$data['amount_received'];?></td>
								<td>
									<?php 
										if($data['is_completed'] == 0){
											echo "<p class=''>Pending</p>";
										}elseif($data['is_completed'] == 1){
											echo "<p class='text-success'>Completed</p>";
										}elseif($data['is_completed'] == 2){
											echo "<p class='text-danger'>Canceled</p>";
										}else{
											echo "<p class='text-danger'>Undifined</p>";
										}
									?>
								</td>
								<td><?=date('d/m/Y h:i a',$data['date']);?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>

				<div class="mt-3">
					<h5>Write a review</h5>
					<form method="post" action="<?=base_url()?>pages/giveReview">
						<textarea class="form-control" style="height: 15rem;" name="review"></textarea>
						<div class="row mt-3">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<button type="submit" class="btn btn-primary btn-block">Give Review</button>
							</div>
							<div class="col-md-4"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<p>Ads</p>
		</div>
	</div>
</div>


<script type="text/javascript">

	
	var htmlfoot ='<footer class="main-footer">© 2019 - <?=date('Y');?> All Rights Reserved : Pay For You, Bangladesh., 01818105488</footer>';


	$(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Blfrtip',
        buttons: [
            

            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                },
				messageTop: '<p align="center">My Orders</p><p align="center"><?=date('d/m/Y h:i a')?></p>',
				title: 'Pay4You | A Trusted Website to Exchange Dollar',
				footer: true,

                messageBottom: htmlfoot,

            },

        ]
    } );
} );	

</script>