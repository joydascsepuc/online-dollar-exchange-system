<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container mt-3" style="background-color: #FFA500; color: black;">
  <?php foreach($info as $data): ?>

    <div class="row text-justify p-5">
      <div class="col-md-6 text-center">
        <h5>About Us</h5>
        <br>
        <p><?=$data['about']?></p>
      </div>
      
      <div class="col-md-6 text-center">
        <h5>Contact Info</h5>
        <br>
        <p class="">Address: <br>
        <?=$data['address']?></p>
        <br>
        <span class="">Mobile:&nbsp;&nbsp;&nbsp;&nbsp;<?=$data['mobile']?></span>
        <p class="">Mailing Support:&nbsp;&nbsp;&nbsp;&nbsp;<?=$data['mail_address']?></p>
        <br>
        <span>Social Support:<br>
          <a href="#" target="_blank"><i class="fab fa-facebook fa-2x"></i></a>&nbsp;&nbsp;
          <a href="#" target="_blank" style="color: #1AADE3"><i class="fab fa-twitter fa-2x"></i></a>&nbsp;&nbsp;
          <a href="#" target="_blank" style="color: #E0584B"><i class="fas fa-envelope fa-2x"></i></a>
        </span>

      </div>
    </div>
  <?php endforeach;?>

  <footer class="page-footer text-center ml-2">
    <?php $year = date('Y'); ?>
    <div class="footer-copyright text-center">© 2019 - <?=$year;?> Copyright : Pay For You<br>Bangladesh.</div>
  </footer>

</div>





<script type="text/javascript">
  $(document).ready( function () {
    $('#datatable').DataTable();
  });

  $('.nav-item a').on('click', function() {
   
    $('.nav-item').children('.dropdown-menu').slideUp(150);
    
    if ($(this).parent().hasClass("show")) {
      $(this).next('.dropdown-menu').slideUp(150);
    } else {
      $(this).next('.dropdown-menu').slideDown(200);
    }

  });
</script>
</body>
</html>