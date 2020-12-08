<div id="messages"></div>
<div class="container">
	<div id="messages"></div>
	<div class="row mb-3">
		<div class="col-12 text-right font-weight-bold">
			<?php if(in_array('createMethods', $user_permission)): ?>
				<a href="<?php echo base_url()?>admin/accounts" type="button" class="btn btn-default">Accounts</a></button>
			<?php endif;?>
		</div>
	</div>
	<?php if(in_array('viewMethods', $user_permission)): ?>
		<table class="table text-center" id="manageTable">
			<thead>
				<tr>
					<th>Account Details</th>
					<th>Amount</th>
          <th>Stock Invoice</th>
          <th>Date</th>
					<th>Description</th>
					<th>Added by</th>
				
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	<?php endif;?>
</div>



<script type="text/javascript">
	var manageTable;
	var base_url = "<?php echo base_url(); ?>";

	$(document).ready(function(){
	  manageTable = $('#manageTable').DataTable({
	    'ajax': base_url + 'admin/getStock',
	  });
	});

</script>

