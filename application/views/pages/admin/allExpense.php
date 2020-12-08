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
	<div class="mt-5">
		<table class="table text-center" id="datatable">
			<thead>
				<tr>
					<th>Category</th>
					<th>Expense Date</th>
					<th>Expense Amount</th>
					<th>Additional Comment</th>
					<th>Data Added By</th>
					<th>Data Added At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data as $data):?>
					<tr>
						<td><?=$data['category'];?></td>
						<td><?=date('d/m/Y',$data['expense_date']);?></td>
						<td><?=$data['amount'];?></td>
						<td><?=$data['additional_comment'];?></td>
						<td><?=$data['added_by'];?></td>
						<td><?=date('d/m/Y h:i a',$data['date']);?></td>
						<td>
							<a type="button" onclick="return confirm('Are You Sure?')" class="btn btn-default" href="<?=base_url()?>admin/editExpense/<?=$data['id']?>"><i class="far fa-edit"></i></a> | 
							<a type="button" onclick="return confirm('Are You Sure?')" href = "" class="btn btn-default"><i class="far fa-trash-alt"></i></a>
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
            'pdf', 

            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                },
				messageTop: '<p align="center">Expense Report</p><br><p align="center"><?=date('d/m/Y h:i a')?></p>',
				title: 'Pay4You | A Trusted Website to Exchange Dollar',
				footer: true,

                messageBottom: htmlfoot,

            },

        ]
    } );
} );	

</script>