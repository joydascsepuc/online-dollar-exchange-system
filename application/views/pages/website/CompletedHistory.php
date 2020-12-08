<div class="container">
	<div class="p-5">
		<h5 class="display-5">Completed History</h5>
		<table class="table table-resonsive text-center">
            <thead>
              <tr>
                <th>Name</th>
                <th>From</th>
                <th>Amount</th>
                <th>To</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($history as $data): ?>
                <tr>
                  <td><?=$data['user_id']?></td>
                  <td><img src="<?=base_url()?>assets/images/methods/<?=$data['from_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td><?=$data['total_amount']?></td>
                  <td><img src="<?=base_url()?>assets/images/methods/<?=$data['to_method']?>" alt="icon" style = "height: 35px; width: 35px;"></td>
                  <td>Pending</td>
                  <td><?=$data['date']?></td>
                </tr>
              <?php endforeach;?>
            </tbody>
        </table>
	</div>
</div>