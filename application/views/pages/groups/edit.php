
  <div class="container text-center">

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">

          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Group</h3>
            </div>
            <form role="form" action="<?php base_url('groups/update') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" value="<?php echo $group_data['group_name']; ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <?php $serialize_permission = unserialize($group_data['permission']); ?>

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
                      <tr>
                        <td>Methods</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createMethods" <?php if($serialize_permission) {
                          if(in_array('createMethods', $serialize_permission)) { echo "checked"; }
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateMethods" <?php
                        if($serialize_permission) {
                          if(in_array('updateMethods', $serialize_permission)) { echo "checked"; }
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewMethods" <?php
                        if($serialize_permission) {
                          if(in_array('viewMethods', $serialize_permission)) { echo "checked"; }
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteMethods" <?php
                        if($serialize_permission) {
                          if(in_array('deleteMethods', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                      </tr>

                      <tr>
                        <td>Websites</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createWeb" <?php if($serialize_permission) {
                          if(in_array('createWeb', $serialize_permission)) { echo "checked"; }
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateWeb" <?php
                        if($serialize_permission) {
                          if(in_array('updateWeb', $serialize_permission)) { echo "checked"; }
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewWeb" <?php
                        if($serialize_permission) {
                          if(in_array('viewWeb', $serialize_permission)) { echo "checked"; }
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteWeb" <?php 
                        if($serialize_permission) {
                          if(in_array('deleteWeb', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                      </tr>


                      <tr>
                        <td>Groups</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroup" <?php
                        if($serialize_permission) {
                          if(in_array('createGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup" <?php
                        if($serialize_permission) {
                          if(in_array('updateGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup" <?php
                        if($serialize_permission) {
                          if(in_array('viewGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup" <?php
                        if($serialize_permission) {
                          if(in_array('deleteGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                      </tr>
                      
                      <tr>
                        <td>Orders</td>
                        <td>--</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateControl" <?php
                        if($serialize_permission) {
                          if(in_array('updateControl', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewControl" <?php
                        if($serialize_permission) {
                          if(in_array('viewControl', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td>-</td>
                      </tr>


                  
                      
                    </tbody>
                  </table>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Changes</button>
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
      $('#manageGroupSubMenu').addClass('active');
    });
  </script>
