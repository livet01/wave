<div class="admin-box">
	<h3>Paramètre</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Libelle du Paramètre</th>
					<th>Valeur du Paramètre</th>
				</tr>
			</thead>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<?php if($record->param_libelle==='format' || $record->param_libelle==='colonnes'){ ?>
				<tr>					
				<?php if ($this->auth->has_permission('Parametre.Content.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/content/parametre/edit/'. $record->param_id, '<i class="icon-pencil">&nbsp;</i>' .  $record->param_libelle) ?></td>
				<?php else: ?>
				<td><?php echo $record->param_libelle ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->param_valeur?></td>
				</tr>
				<?php } ?>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="3">Aucun enregistrement trouvé correspondant à votre sélection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>