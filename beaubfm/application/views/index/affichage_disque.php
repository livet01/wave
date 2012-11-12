<?php 
if(!empty($data)) { 
	
	?>
			<li><i class="icon-music"></i><?php echo $data['dis_libelle']; ?></li>
			<li><i class="icon-file"></i><?php echo $data['dis_format']; ?></li>
			<li><i class="icon-group"></i><?php echo $data['art_nom']; ?></li>
			<li><i class="icon-home"></i><?php echo $data['per_nom']; ?></li>
			<li><i class="icon-hdd"></i><?php echo $data['emp_libelle']; ?></li>
			<li><i class="icon-headphones"></i><?php echo 'admin'; ?></li>			<li><i class="icon-comments"></i><?php echo $data['emb_id']; ?></li>
<?php 
} ?>

