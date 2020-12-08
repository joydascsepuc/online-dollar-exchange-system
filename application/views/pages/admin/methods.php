<div class="container">
	<div id="messages"></div>
	<div class="row mb-3">
		<div class="col-12 text-right font-weight-bold">
			<?php if(in_array('createMethods', $user_permission)): ?>
				<a href="<?php echo base_url()?>admin/LoadAddMethod" type="button" class="btn btn-default">Add Method</a>
			<?php endif;?>
		</div>
	</div>
	<?php if(in_array('viewMethods', $user_permission)): ?>
		<table class="table text-center" id="manageTable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Balance</th>
					<th>Pending Order Amount</th>
					<th>Processing Fee</th>
					<th>Buy Rate</th>
					<th>Sell Rate</th>
					<!-- <th>Account Number</th> -->
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	<?php endif;?>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Information</h4>
      </div>

      <form role="form" action="<?php echo base_url('admin/updateMInfo') ?>" method="post" id="updateForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="title">Processing Fee</label>
            <input type="text" class="form-control" id="pfee" name="pfee" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="title">Today's Buy Rate</label>
            <input type="text" class="form-control" id="tbr" name="tbr" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="title">Today's Sell Rate</label>
            <input type="text" class="form-control" id="tsr" name="tsr" autocomplete="off" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>

    </div>
  </div>
</div>



<script type="text/javascript">
	var manageTable;
	var base_url = "<?php echo base_url(); ?>";

	$(document).ready(function(){
	  manageTable = $('#manageTable').DataTable({
	    'ajax': base_url + 'admin/getMethods',
	  });
	});


	/*For Edit and Update Slider*/
	function editFunc(id){
	  $.ajax({
	    url: base_url + 'admin/fetchMethodDataById/'+id,
	    type: 'post',
	    dataType: 'json',
	    success:function(response){

	      $("#pfee").val(response.processing_fee);
	      $("#tbr").val(response.buy_rate);
	      $("#tsr").val(response.sell_rate);
	      $("#updateForm").unbind('submit').bind('submit', function(){
	        var form = $(this);

	        $(".text-danger").remove();

	        $.ajax({
	          url: form.attr('action') + '/' + id,
	          type: form.attr('method'),
	          data: form.serialize(),
	          dataType: 'json',
	          success:function(response) {
	            manageTable.ajax.reload(null, false);
	            if(response.success === true){
	              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
	                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
	                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
	              '</div>');

	              $("#editModal").modal('hide');
	              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

	            }else{

	              if(response.messages instanceof Object){
	                $.each(response.messages, function(index, value){
	                  var id = $("#"+index);

	                  id.closest('.form-group')
	                  .removeClass('has-error')
	                  .removeClass('has-success')
	                  .addClass(value.length > 0 ? 'has-error' : 'has-success');

	                  id.after(value);

	                });
	              } else {
	                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
	                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
	                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
	                '</div>');
	              }
	            }
	          }
	        });

	        return false;
	      });

	    }
	  });
	}

</script>

