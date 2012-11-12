<?php 
if(!empty($data)) { 
	

?>

<table>
	<caption>
		<?php echo $data['dis_libelle']; ?>
	</caption>

	<tr>
		<td class="icon"><i class="icon-file"></i></td>
		<td class="detail"><?php echo $data['dis_format']; ?></td>
	</tr>
	<tr class="dark">
		<td class="icon"><i class="icon-group"></i></td>
		<td class="detail"><?php echo $data['art_nom']; ?></td>
	</tr>
	<tr>
		<td class="icon"><i class="icon-home"></i></td>
		<td class="detail"><?php echo $data['per_nom']; ?></td>
	</tr>
	<tr class="dark">
		<td class="icon"><i class="icon-hdd"></i></td>
		<td class="detail"><?php echo $data['emp_libelle']; ?></td>
	</tr>
	<tr>
		<td class="icon"><i class="icon-headphones"></i></td>
		<td class="detail"><?php echo 'admin'; ?></td>
	</tr>
	<tr class="dark">
		<td class="icon"><i class="icon-comments"></i></td>
		<td class="detail"><?php echo $data['emb_id']; ?></td>
	</tr>

</table>


<?php
}
 ?>

