<div class="container p-5">
	
	<div class="row mb-5">
		<div class="col-12 text-right">
			<?php if(in_array('createWeb', $user_permission)): ?>
				<a type="button" class="btn btn-warning" data-toggle="modal" data-target="#addModal">Add Notice</a>
			<?php endif;?>
		</div>
	</div>

	<div id="messages"></div>
	<?php if(in_array('viewWeb', $user_permission)): ?>
		<table class="table text-center" id="manageTable">
			<thead>
				<tr>
					<th>Title</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	<?php endif;?>
</div>



<!-- For Add an Option -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Notice</h4>
      </div>

      <form role="form" action="<?php echo base_url('admin/addNotice') ?>" method="post" id="addForm">
        <div class="modal-body">
          <div id="messages"></div>
          <div class="form-group">
            <label for="option">Option Text</label>
            <input type="text" class="form-control" id="option" name="option" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active" required>
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Edit Notice -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Notice</h4>
      </div>

      <form role="form" action="<?php echo base_url('admin/updateNotice') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="notice">Notice</label>
            <input type="text" class="form-control" id="notice" name="notice" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="edit_active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active" required>
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
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
	    'ajax': base_url + 'admin/getAllNotices',
	  });
	});

	function editFunc(id){
	  $.ajax({
	    url: base_url + 'admin/fetchNoticeDataById/'+id,
	    type: 'post',
	    dataType: 'json',
	    success:function(response){

	      $("#notice").val(response.title);
	      $("#edit_active").val(response.active);
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