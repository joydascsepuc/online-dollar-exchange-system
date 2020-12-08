<div class="container">
	<a href="<?php echo base_url()?>admin/editComInfo" class = "float-right">Edit Information</a>
	<div class="p-5">
		<table class="table table-striped table-light">
			 <tbody>
			 	<?php foreach($info as $data):?>
				 	<tr>
				 		<th>Company Name</th>
				 		<td><?php echo $data['name']; ?></td>
				 	</tr>
				 	<tr>
				 		<th>Contact Number</th>
				 		<td><?php echo $data['mobile']; ?></td>
				 	</tr>
				 	<tr>
				 		<th>Mailing Address</th>
				 		<td><?php echo $data['mail_address']; ?></td>
				 	</tr>
				 	<tr>
				 		<th>Facebook Link</th>
				 		<td><?php echo $data['fb_link']; ?></td>
				 	</tr>
				 	<tr>
				 		<th>Twitter Link</th>
				 		<td><?php echo $data['twitter_link']; ?></td>
				 	</tr>
				 	<tr>
				 		<th>Company Address</th>
				 		<td><?php echo $data['address']; ?></td>
				 	</tr>
				 	<tr>
				 		<th>About Us</th>
				 		<td><?php echo $data['about']; ?></td>
				 	</tr>
			 	<?php endforeach;?>
			 </tbody>
		</table>
	</div>
</div>