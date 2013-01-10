<?php 
if(!empty($data)) { 
	
?>
<td></td>
<td colspan="5">
<?php if(!empty($data['dis_format'])) { ?><span class="label label-info" style="margin: 0 5px; "><i class="icon-file icon-white"></i> <?php echo $data['dis_format'];  ?></span><?php } ?>
<?php if(!empty($data['emp_libelle'])) { ?><span class="label label-important"style="margin: 0 5px;"><i class="icon-hdd icon-white"></i> <?php echo $data['emp_libelle'];  ?></span><?php } ?>
<?php if(!empty($data['mem_nom'])) { ?><span class="label label-success" style="margin: 0 5px;"><i class="icon-headphones icon-white"></i> <?php echo $data['mem_nom'];?></span><?php } ?>
<?php if(!empty($data['sty_libelle'])) { ?><span class="label label-inverse" style="margin:  0 5px;"><i class="icon-certificate icon-white"></i> <?php echo $data['sty_libelle'];  ?></span><?php } ?>
<?php if(!empty($data['emb_id'])) { ?><span class="label label-warning" style="margin:  0 5px;"><i class="icon-comment icon-white"></i> <?php echo $data['emb_id']; ?></span><?php } ?>
<?php if(!empty($data['col1'])) { ?><span class="label " style="margin:  0 5px;"><i class="icon-plus icon-white"></i> <?php echo $colonne[0];  ?> : <?php echo $data['col1'];  ?></span><?php } ?>
<?php if(!empty($data['col2'])) { ?><span class="label " style="margin:  0 5px;"><i class="icon-plus icon-white"></i> <?php echo $colonne[1];  ?> : <?php echo $data['col2']; ?></span><?php } ?>
<?php if(!empty($data['col3'])) { ?><span class="label " style="margin:  0 5px;"><i class="icon-plus icon-white"></i> <?php echo $colonne[2];  ?> : <?php echo $data['col3']; ?></span><?php } ?>
<?php if(!empty($data['col4'])) { ?><span class="label " style="margin:  0 5px;"><i class="icon-plus icon-white"></i> <?php echo $colonne[3];  ?> : <?php echo $data['col4']; ?></span><?php } ?>
<?php if(!empty($data['col5'])) { ?><span class="label " style="margin:  0 5px;"><i class="icon-plus icon-white"></i> <?php echo $colonne[4];  ?> : <?php echo $data['col5']; ?></span><?php } ?>
<?php if(!empty($data['col6'])) { ?><span class="label " style="margin:  0 5px;"><i class="icon-plus icon-white"></i> <?php echo $colonne[5];  ?> : <?php echo $data['col6']; ?></span><?php } ?>

</td>
<?php
}
 ?>

