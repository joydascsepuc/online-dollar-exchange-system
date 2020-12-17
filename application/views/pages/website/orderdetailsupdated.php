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

<div class="container">
	<div class="p-3">
		<table class="table table-striped table-light text-center">
		 	<tbody>
		 		<?php foreach($data as $value):?>
			 		<tr>
			 			<th>Customer Name</th>
			 			<td><?php echo $value['user_id']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>Invoice</th>
			 			<td><?php echo $value['invoice']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>From</th>
			 			<td><?php echo $value['from_method']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>From Account No</th>
			 			<td><?php echo $value['from_account_no']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>Tranx ID</th>
			 			<td><?php echo $value['tranx_id']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>To Method</th>
			 			<td><?php echo $value['to_method']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>To Account No</th>
			 			<td><?php echo $value['to_account_no']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>Amount Given</th>
			 			<td><?php echo $value['amount_give']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>Processing Fee</th>
			 			<td><?php echo $value['processing_fee']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>Amount Received</th>
			 			<td><?php echo $value['amount_received']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>Status</th>
			 			<td>
			 				<?php 
								if($value['is_completed'] == 0){
									echo "<p class=''>Pending</p>";
								}elseif($value['is_completed'] == 1){
									echo "<p class='text-success'>Completed</p>";
								}elseif($value['is_completed'] == 2){
									echo "<p class='text-danger'>Canceled</p>";
								}else{
									echo "<p class='text-danger'>Undifined</p>";
								}
							?>
			 			</td>
			 		</tr>
			 		<tr>
			 			<th>Date</th>
			 			<td><?php echo $value['date']; ?></td>
			 		</tr>
			 		<tr>
			 			<th>Completed By</th>
			 			<td><?php echo $value['completed_by']; ?></td>
			 		</tr>
		 		<?php endforeach;?>
			 </tbody>
		</table>
	</div>
</div>