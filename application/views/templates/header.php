<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css';?>">
    <!-- <link rel="icon" href="<?php echo base_url().'assets/images/icon/icon.png';?>"> -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/fontawsome/css/all.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/jquery/jquery-ui.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.min.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/font.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/fontawsome/css/all.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/font.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
    <script src="<?php echo base_url().'assets/js/jquery-3.4.1.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/popper.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'; ?>"></script>

    <!-- MS DROPDOWN -->
    <!-- <script src="<?php echo base_url().'assets/msDropdownMaster/js/msdropdown/jquery-1.3.2.min.js';?>" type="text/javascript"></script> -->
    <script src="<?php echo base_url().'assets/msDropdownMaster/js/msdropdown/jquery.dd.min.js';?>" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/msDropdownMaster/css/msdropdown/dd.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/msDropdownMaster/css/msdropdown/personalcss.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'/assets/css/style.css';?>">
    <script src="<?php echo base_url('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
    <title>Pay4You | A Trusted Website to Exchange Dollars</title>
</head>
<body style="background-color: #87CEEB;">

   <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFA500;">
        <a class="navbar-brand" href="<?php echo base_url()?>">Pay4You</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <?php if($this->session->userdata('logged_in')):?>
            <?php if($user_permission): ?>
            <ul class="navbar-nav mr-auto">
              <?php if(in_array('createMethods', $user_permission) || in_array('updateMethods', $user_permission) || in_array('viewMethods', $user_permission) || in_array('deleteMethods', $user_permission)): ?>
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Methods
                  </a>
                  <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url() ?>admin/methods">Methods</a>
                    <a class="dropdown-item" href="<?php echo base_url()?>admin/accounts">Accounts</a>
                  </div>
              </li>
              <?php endif;?>

              <?php if(in_array('updateControl', $user_permission) || in_array('viewControl', $user_permission)): ?>
              <li class="nav-item dropdown">
                <?php if ($notifications['pendingOrder']!=0): ?>
                  <span class="badge badge-pill badge-primary" style="float:right;margin-bottom:-20px;"><?=$notifications['pendingOrder']?></span>
                <?php endif ?>
                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Manage Orders
                </a>
                <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                  <?php if ($notifications['pendingOrder']!=0): ?>
                  <span class="badge badge-pill badge-primary" style="float:right;margin-bottom:-20px;"><?=$notifications['pendingOrder']?></span>
                <?php endif ?>
                  
                  <a class="dropdown-item" href="<?php echo base_url()?>admin/pendings">Pending Orders</a>
                  <a class="dropdown-item" href="<?php echo base_url()?>admin/allOrders">All Orders</a>
                </div>
              </li>
               <!--  <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url()?>admin/pendings">Pending Orders</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url()?>admin/allOrders">All Orders</a>
                </li> -->
              <?php endif;?>

              <?php if(in_array('createWeb', $user_permission) || in_array('updateWeb', $user_permission) || in_array('viewWeb', $user_permission) || in_array('deleteWeb', $user_permission)): ?>
              <li class="nav-item dropdown">
                <?php if ($notifications['pendingReview']!=0): ?>
                  <span class="badge badge-pill badge-primary" style="float:right;margin-bottom:-20px;"><?=$notifications['pendingReview']?></span>
                <?php endif ?>
                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Manage Website
                </a>
                <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo base_url()?>admin/manageNotices">Notices</a>
                  <a class="dropdown-item" href="<?php echo base_url()?>admin/companyInfo">Company Info</a>
                  <?php if ($notifications['pendingReview']!=0): ?>
                  <span class="badge badge-pill badge-primary" style="float:right;margin-bottom:-20px;"><?=$notifications['pendingReview']?></span>
                  <?php endif ?>
                  <a class="dropdown-item" href="<?php echo base_url()?>admin/pendingReviews">Pending Reviews</a>
                  <a class="dropdown-item" href="<?php echo base_url()?>admin/loadadvertise">Advertisement</a>
                </div>
              </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url()?>admin/manageNotices">Notices</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url()?>admin/companyInfo">Company Info</a>
                </li> -->
              <?php endif;?>
              <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Manage Groups
                  </a>
                  <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                    <?php if(in_array('createGroup', $user_permission)): ?>
                      <a class="dropdown-item" href="<?php echo base_url(); ?>groups/create">Add Groups</a>
                    <?php endif;?>
                    <?php if(in_array('viewGroup', $user_permission)): ?>
                      <a class="dropdown-item" href="<?php echo base_url();?>groups/index">View All</a>
                    <?php endif;?>
                  </div>
                </li>
                <?php endif;?>

                <?php if(in_array('createMethods', $user_permission) || in_array('updateMethods', $user_permission) || in_array('viewMethods', $user_permission) || in_array('deleteMethods', $user_permission)): ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Investment
                  </a>
                  <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url()?>admin/loadAddInvestor">Add Investor</a>
                    <a class="dropdown-item" href="<?php echo base_url()?>admin/allInvestors">All Investors</a>
                    <a class="dropdown-item" href="<?php echo base_url()?>admin/loadInvest">Invest</a>
                    <a class="dropdown-item" href="<?php echo base_url()?>admin/allInvests">All Invests</a>
                  </div>
                </li>
              <?php endif;?>

              <?php if(in_array('createMethods', $user_permission) || in_array('updateMethods', $user_permission) || in_array('viewMethods', $user_permission) || in_array('deleteMethods', $user_permission)): ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Expenditure
                  </a>
                  <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url()?>admin/loadAddCategory">Add Category</a>
                    <a class="dropdown-item" href="<?php echo base_url()?>admin/allCategories">All Categories</a>
                    <a class="dropdown-item" href="<?php echo base_url()?>admin/expense">Add Expense</a>
                    <a class="dropdown-item" href="<?php echo base_url()?>admin/allExpense">All Expenses</a>
                  </div>
                </li>
              <?php endif;?>

              </ul>
            <?php endif;?>
          <?php endif;?>
          
          <ul class="navbar-nav ml-auto mt-2">
            <?php if($this->session->userdata('logged_in')):?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>pages/myOrders">My Orders</a>
            </li>
            <?php endif;?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ?>pages/contact">Contact</a>
            </li>
            <?php if(!$this->session->userdata('logged_in')):?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() ?>pages/registration">Registration</a>
              </li>
              <li class="nav-item">
                <a class="nav-link font-weight-bold text-dark" href="#" type="button" data-toggle="modal" data-target="#signinModal"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Login</a>
              </li>
            <?php endif;?>
            <?php if($this->session->userdata('logged_in')):?>
              <li class="nav-item dropdown" id="profile">
                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle fa-2x"></i></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item text-dark" href="<?php echo base_url()?>pages/profile"><i class="fas fa-user-alt"></i>&nbsp;Profile</a>
                  <a class="dropdown-item text-dark" href="<?php echo base_url();?>auth/logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                </div>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link font-weight-bold text-dark" href="<?php echo base_url()?>auth/logout" type="button"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Logout</a>
              </li> -->
            <?php endif;?>
          </ul>
        </div>
      </nav>
   </div>



  <!--1.Login Modal-->
  <div class="modal fade modal-content-right" id="signinModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content" id="signinContent" style="height: 25rem !important;">
        <div class="modal-header pb-0" style="margin-bottom: 12px;">
          <div>
              <h3 class="modal-title">Log In</h3>
              <em>to your account</em>
          </div>
          <button class="btn btn-icon btn-sm btn-text-secondary rounded-circle" type="button" data-dismiss="modal">
            <i class="material-icons">close</i>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open('auth/login');?>
              <div class="form-group">
                <span class="input-icon">
                <i class="material-icons">Mobile Number</i>
                <input type="text" class="form-control" name="mobile" id="" placeholder="Ex : 01********" required>
                </span>
              </div>
              <div class="form-group">
                <span class="input-icon">
                  <i class="material-icons">Password</i>
                  <input type="password" class="form-control" name="password" id="" placeholder="" required>
                </span>
              </div>
            <div class="form-group d-flex justify-content-between">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rememberCheck" checked>
                    <label class="custom-control-label" for="rememberCheck">Remember me</label>
                </div>
                <u><a href="<?=base_url()?>pages/forgotPassword" class="text-primary small">Forgot password?</a></u>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5" style="padding: .15rem .75rem;">Sign In</button>
          </form>
        </div>
      </div>
    </div>
  </div>

        





<div class="container">

  <?php if($this->session->flashdata('registered')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('registered');'</p>'?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif;?>

  <?php if($this->session->flashdata('registered_not')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('registered_not');'</p>'?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif;?>

  <?php if($this->session->flashdata('validation_loss')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('validation_loss');'</p>'?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif;?>

  <?php if($this->session->flashdata('email_sent')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('email_sent');'</p>'?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif;?>

  <?php if($this->session->flashdata('email_not_sent')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('email_not_sent');'</p>'?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif;?>

  <?php if($this->session->flashdata('license')): ?>
  <?php echo '<p class="alert alert-danger font-weight-bold">'.$this->session->flashdata('license');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('login_successfull')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('login_successfull');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('wrong')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('wrong');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('image_not_uploading')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('image_not_uploading');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('image_not_found')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('image_not_found');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('method_not_added')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('method_not_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('method_added')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('method_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('method_updated')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('method_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('method_not_updated')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('method_not_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('method_deleted')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('method_deleted');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('method_not_deleted')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('method_not_deleted');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('notice_added')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('notice_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('notice_not_added')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('notice_not_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('notice_deleted')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('notice_deleted');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('notice_not_deleted')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('notice_not_deleted');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('info_updated')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('info_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('info_not_updated')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('info_not_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('loginFirst')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('loginFirst');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('cannotplace')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('cannotplace');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('orderPlaced')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('orderPlaced');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('order_completed')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('order_completed');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('order_not_completed')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('order_not_completed');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('order_canceled')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('order_canceled');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('order_not_canceled')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('order_not_canceled');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('profile_updated')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('profile_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('profile_not_updated')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('profile_not_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('investor_added')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('investor_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('investor_not_added')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('investor_not_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('invest_added')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('invest_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('invest_not_added')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('invest_not_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('category_added')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('category_not_added')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('category_not_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('expense_added')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('expense_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('expense_not_added')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('expense_not_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('investor_updated')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('investor_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('investor_not_updated')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('investor_not_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('invest_updated')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('invest_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('invest_not_updated')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('invest_not_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('category_updated')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('category_not_updated')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('category_not_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('expense_updated')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('expense_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('expense_not_updated')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('expense_not_updated');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>


  <?php if($this->session->flashdata('review_added')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('review_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>


  <?php if($this->session->flashdata('review_not_added')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('review_not_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('r_added')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('r_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('r_not_added')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('r_not_added');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('r_delete')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('r_delete');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('r_not_delete')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('r_not_delete');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('not_possible')): ?>
  <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('not_possible');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>

  <?php if($this->session->flashdata('p_changed')): ?>
  <?php echo '<p class="alert alert-success">'.$this->session->flashdata('p_changed');'</p>' ?>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <?php endif; ?>



















  
</div>