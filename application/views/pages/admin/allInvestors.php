<div class="container">
	<div class="mt-5">
		<table class="table text-center" id="datatable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Mobile</th>
					<th>Percentage</th>
					<th>Address</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data as $data):?>
					<tr>
						<td><?=$data['name'];?></td>
						<td><?=$data['mobile'];?></td>
						<td><?=$data['percentage'];?></td>
						<td><?=$data['address'];?></td>
						<td>
							<a type="button" onclick="return confirm('Are You Sure?')" class="btn btn-default" href="<?=base_url()?>admin/editInvestor/<?=$data['id']?>"><i class="far fa-edit"></i></a> | 
							<a type="button" onclick="return confirm('Are You Sure?')" href = "" class="btn btn-default"><i class="far fa-trash-alt"></i></a>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>