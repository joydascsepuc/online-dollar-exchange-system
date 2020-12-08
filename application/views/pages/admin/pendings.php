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



<style type="text/css">
	.btn{
		padding: .010rem .25rem;
	}
</style>

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
					<th>Actions</th>
				</tr>
			</thead>
		</table>
	</div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Order Confirmation</h4>
      </div>

      <form role="form" action="<?php echo base_url('admin/completeOrderNow') ?>" method="post" id="updateForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" readonly class="form-control" id="amount" name="amount" autocomplete="off"> 
          </div>
          <div class="form-group">
            <label for="sendingAcc">Money Sending Account</label>
            <select class="form-control" id="sendingAcc" name="sendingAcc">
             <!-- <?php foreach ($accounts as $key => $value): ?>
             	<option value="<?=$value['id']?>"><?=$value['methodName']?>-<?=$value['acNumber']?></option>
             <?php endforeach ?> -->
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="submit" onclick="singleClick();" type="button" class="btn btn-primary">Save changes</button>
        </div>

      </form>

    </div>
  </div>
</div>


<script type="text/javascript">
	var manageTable;
	var base_url = "<?php echo base_url(); ?>";
	var htmlfoot ='<footer class="main-footer">© 2019 - <?=date('Y');?> All Rights Reserved : Pay For You, Bangladesh., 01818105488</footer>';

	$(document).ready(function(){


	  manageTable = $('#datatable').DataTable({
	    'ajax': base_url + 'admin/getPendings',

	    dom: 'Blfrtip',
        buttons: [
            

            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6.7,8,9,10 ]
                },
				messageTop: '<p align="center">Pending Order Report</p><br><p align="center"><?=date('d/m/Y h:i a')?></p>',
				title: 'Pay4You | A Trusted Website to Exchange Dollar',
				footer: true,

                messageBottom: htmlfoot,

            },

        ]



	  });
	});


	/*For Edit and Update Slider*/
	function editFunc(id){
	  $.ajax({
	    url: base_url + 'admin/fetchOrderDataById/'+id,
	    type: 'post',
	    dataType: 'json',
	    success:function(response){

	      $("#amount").val(response.amount_received);
	      var amount_received = response.amount_received;
	      var to_method = response.to_method;
	      console.log(amount_received);
	      console.log(to_method);
	      $.ajax({
                url:base_url + 'admin/getSendingAcc',
                type: "POST",
                data: {'amount_received' : amount_received, 'to_method': to_method},
                dataType: 'json',
                success: function(data){
                    $('#sendingAcc').html(data);
                },
            });



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

	function confirmDelete() {
        return confirm('Are you sure??');
    }


    function singleClick() {
	      
	      $("#updateForm").submit();
	      $("#submit").attr("disabled", true); 
    }

</script>