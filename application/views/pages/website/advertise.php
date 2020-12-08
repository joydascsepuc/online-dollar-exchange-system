<div class="container">
  <div id="messages"></div>
  <div class="row mb-3">
    <div class="col-12 text-right font-weight-bold">
      <?php if(in_array('createMethods', $user_permission)): ?>
        <a href="<?php echo base_url()?>admin/LoadAddMethod" type="button" class="btn btn-default">Add Method</a>
      <?php endif;?>
    </div>
  </div>

  <div class="row">

  <div class="col-6">
      <form role="form" action="<?php echo base_url('admin/createAdv') ?>" method="post" id="createForm">
      <label for="name">Placement Name</label>
      <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>

      <label for="ad">Ad Link</label>
      <textarea name="ad" id="ad" class="form-control"></textarea>
      <input type="hidden" id="id" name="id" value="0" required>

      <label for="active">Status</label>
        <select class="form-control" id="active" name="active" required>
          <option value="1">Active</option>
          <option value="2">Inactive</option>
        </select>
     <br>
    <button type="submit" id="submitButton" onclick="return confirm('Are You Sure?')" class="btn btn-outline-primary btn-block">Add</button>
     </form>
    </div>
  <div class="col-6">

  <?php if(in_array('viewMethods', $user_permission)): ?>
    <table class="table text-center" id="manageTable">
      <thead>
        <tr>
            <th>Placement</th>
            <th>Ad Link</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  <?php endif;?>
</div>
</div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Remove Accounts</h4>
      </div>

      <form role="form" action="<?php echo base_url('admin/removeAdv') ?>" method="post" id="removeForm">
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



<script type="text/javascript">
  var manageTable;
  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function(){
    manageTable = $('#manageTable').DataTable({
      'ajax': base_url + 'admin/getadvertise',
       "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
       "order" : []
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
          //$("#addModal").modal('hide');

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');
          $("#submitButton").text('Add');

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

  /*For Edit and Update Slider*/
  function editFunc(id){
    $.ajax({
      url: base_url + 'admin/fetchAdvDataById/'+id,
      type: 'post',
      dataType: 'json',
      success:function(response){

        $("#name").val(response.placement);
        $("#ad").val(response.adlink);
        $("#active").val(response.active);
        $("#id").val(response.id);
        $("#submitButton").text('Edit');
        
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

</script>

