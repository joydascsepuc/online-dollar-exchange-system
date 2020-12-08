<style type="text/css">
	.btn{
		padding: .010rem .25rem;
	}
</style>

<div class="container">
	<div class="p-3">
		<table class="table text-center" id="dataTable">
			<thead>
				<tr>
					<th>User Name</th>
					<th>Review</th>
					<th>Date</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data as $value):?>
					<tr>
						<td><?=$value['user_id'];?></td>
						<td><?=$value['review'];?></td>
						<td><?=date('d/m/Y h:i a',$value['date']);?></td>
						<td>
							<a href="<?php echo base_url()?>admin/acceptReview/<?=$value['id']?>" class="btn btn-success" onclick="return confirm('Are You Sure?')">Pulish</a>
							<a href="<?php echo base_url()?>admin/deleteReview/<?=$value['id']?>" class="btn btn-danger" onclick="return confirm('Are You Sure?')">Delete</a>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>