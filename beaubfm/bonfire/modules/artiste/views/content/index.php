<div class="admin-box">
	<h3>Artiste</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Artiste.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Nom de l'artiste</th>
					<th>Identifiant Radio : 1</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Artiste.Content.Delete')) : ?>
				<tr>
					<td colspan="3">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('artiste_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Artiste.Content.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->art_id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Artiste.Content.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/content/artiste/edit/'. $record->art_id, '<i class="icon-pencil">&nbsp;</i>' .  $record->art_nom) ?></td>
				<?php else: ?>
				<td><?php echo $record->art_nom ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->rad_id?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="3">Aucun artiste n'a été trouvé.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>