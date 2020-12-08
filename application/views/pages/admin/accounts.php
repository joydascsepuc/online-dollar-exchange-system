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



<div id="messages"></div>
<div class="container">
	<div id="messages"></div>
	<div class="row mb-3">
		<div class="col-12 text-right font-weight-bold">
			<?php if(in_array('createMethods', $user_permission)): ?>
        <button class="btn btn-default" data-toggle="modal" data-target="#addModal">Add Accounts</button>
				<a href="<?php echo base_url()?>admin/stock" type="button" class="btn btn-default">Stock</a></button>
			<?php endif;?>
		</div>
	</div>
	<?php if(in_array('viewMethods', $user_permission)): ?>
		<table class="table text-center" id="manageTable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Method Name</th>
					<th>Balance</th>
					<!-- <th>Account Number</th> -->
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	<?php endif;?>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Account</h4>
      </div>
	
      <form role="form" action="<?php echo base_url('admin/addAccount') ?>" method="post" id="createForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="acNumber">Account Number</label>
			<input type="text" name="acNumber" class="form-control" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="method" class="mt-2">Method</label>
			<select id="method" class="form-control" name="method" required>
				<option value="">Choose...</option>
					<?php foreach ($methods as $key => $value): ?>
						<option value="<?=$value['id']?>"><?=$value['name']?></option>
					<?php endforeach ?>
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


<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Edit Accounts</h4>
      </div>

      <form role="form" action="<?php echo base_url('admin/editAccount') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div class="form-group">
            <label for="edit_acNumber">Account Number</label>
			<input type="text" id="edit_acNumber" name="edit_acNumber" class="form-control" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="edit_method" class="mt-2">Method</label>
			<select id="edit_method" class="form-control" name="edit_method" required>
					<option value="">Choose...</option>
					<?php foreach ($methods as $key => $value): ?>
						<option value="<?=$value['id']?>"><?=$value['name']?></option>
					<?php endforeach ?>
				</select>
          </div>
          
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Remove Accounts</h4>
      </div>

      <form role="form" action="<?php echo base_url('admin/removeAccount') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="stockModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Stock Information</h4>
      </div>

      <form role="form" action="<?php echo base_url('admin/stockUpdate') ?>" method="post" id="stockForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="stock">Stock Amount</label>
            <input type="number" min="1" step="any" class="form-control" id="stock" name="stock" autocomplete="off" required>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description"  class="form-control" name="description" placeholder="Describe about the transaction details (if any)" autocomplete="off"></textarea>
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
  var htmlfoot ='<footer class="main-footer">© 2019 - <?=date('Y');?> All Rights Reserved : Pay For You, Bangladesh., 01818105488</footer>';
  var date = date('d/m/Y h:i a');
	$(document).ready(function(){
	  manageTable = $('#manageTable').DataTable({
	    'ajax': base_url + 'admin/getAccounts',
      dom: 'Blfrtip',
        buttons: [
            

            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                },
        messageTop: '<p align="center">Account Balance Report</p><br><p align="center"><?=date('d/m/Y h:i a')?></p>',
        title: 'Pay4You | A Trusted Website to Exchange Dollar',
        footer: true,

                messageBottom: htmlfoot,

            },

        ]


	  });
	});

	$("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false);

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
          $("#addModal").modal('hide');

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
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
	function editFunc(id)
{
  $.ajax({
    url: base_url + 'admin/fetchAccountDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_acNumber").val(response.acNumber);
      //$("#edit_description").data("wysihtml5").setValue(response.description);
      $("#edit_method").val(response.methodID);
      //$('#edit_description ~ iframe').contents().find('.wysihtml5-editor').html(response.description);
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false);

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
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


function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { id:id },
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false);
          // hide the modal
            $("#removeModal").modal('hide');

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');



          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      });

      return false;
    });
  }
}



function stockFunc(id){

        $("#stockForm").unbind('submit').bind('submit', function(){
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

                $("#stockModal").modal('hide');
                $("#stockForm .form-group").removeClass('has-error').removeClass('has-success');

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
</script>

