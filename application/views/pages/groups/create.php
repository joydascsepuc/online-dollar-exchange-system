
  <div class="container text-center">

    <section class="content mt-4">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Group</h3>
            </div>
            <form role="form" action="<?php base_url('groups/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="permission">Permissions</label>

                  <table class="table text-center">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>

                      <!-- To CRUD methods -->
                      <tr>
                        <td>Methods</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createMethods"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateMethods"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewMethods"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteMethods"></td>
                      </tr>
                      
                      <!-- To CRUD notices & updated Company Info -->
                      <tr>
                        <td>Websites</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createWeb"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateWeb"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewWeb"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteWeb"></td>
                      </tr>

                      <!-- Can Create a new Group -->
                      <tr>
                        <td>Groups</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroup"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup"></td>
                      </tr>

                      <!-- Only Control Orders -->
                      <tr>
                        <td>Orders</td>
                        <td>--</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateControl"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewControl"></td>
                        <td>--</td>
                      </tr>

                    
                      
                      
                    </tbody>
                  </table>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('groups/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      $('#topMainNav').addClass('active');
      $('#groupMainNav').addClass('active');
      $('#createGroupSubMenu').addClass('active');
    });
  </script>
