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
	<div class="mt-5">
		<table class="table text-center" id="datatable">
			<thead>
				<tr>
					<th>Name</th>
					<th>From</th>
					<th>Amount</th>
					<th>P. Fee</th>
					<th>Total</th>
					<th>Trnx. From</th>
					<th>Trnx. Number</th>
					<th>Need At</th>
					<th>Amount</th>
					<th>To Acc</th>
					<th>Invoice</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data as $data):?>
					<tr>
						<td><?=$data['user_id'];?></td>
						<td><img src="<?=base_url().$data['from_method']?>" alt="icon" style = "height: 35px; width: 35px;">
							<?=$data['from_method_account']?></td>
						<td><?=$data['amount_give'];?></td>
						<td><?=$data['processing_fee'];?></td>
						<td><?=$data['total_amount'];?></td>
						
						<td><?=$data['from_account_no'];?></td>
						<td><?=$data['tranx_id'];?></td>

						<td><img src="<?=base_url().$data['to_method']?>" alt="icon" style = "height: 35px; width: 35px;">
						<?=$data['to_method_account']?></td>
						<td><?=$data['amount_received'];?></td>
						
						
						<td><?=$data['to_account_no'];?></td>
						<td><?=$data['invoice'];?></td>
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
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>


<script type="text/javascript">

	
	var htmlfoot ='<footer class="main-footer">© 2019 - <?=date('Y');?> All Rights Reserved : Pay For You, Bangladesh., 01818105488</footer>';


	$(document).ready(function() {
    $('#datatable').DataTable( {
        dom: 'Blfrtip',
        buttons: [
            

            {
                extend: 'print',
                // exportOptions: {
                //     columns: [ 0, 1, 2, 3,4,5 ]
                // },
				messageTop: '<p align="center">Order Report</p><br><p align="center"><?=date('d/m/Y h:i a')?></p>',
				title: 'Pay4You | A Trusted Website to Exchange Dollar',
				footer: true,

                messageBottom: htmlfoot,

            },

        ]
    } );
} );	

</script>