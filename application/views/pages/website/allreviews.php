<div class="container">
	<div class="p-3">
		<?php foreach($data as $review):?>
            <h5><?=$review['user_id']?></h5>
            <p><?=$review['review']?></p>
            <br>
         <?php endforeach;?>
	</div>
</div>