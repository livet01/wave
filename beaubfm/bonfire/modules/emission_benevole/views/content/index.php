<div class="admin-box">
	<h3>Emission Bénévole</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Emission_Benevole.Content.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Nom de l'emission bénévole</th>
					<th>Identifiant Radio</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Emission_Benevole.Content.Delete')) : ?>
				<tr>
					<td colspan="3">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('emission_benevole_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					
				<?php if ($this->auth->has_permission('Emission_Benevole.Content.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/content/emission_benevole/edit/'. $record->emb_id, '<i class="icon-pencil">&nbsp;</i>' .  $record->emb_libelle) ?></td>
				<?php else: ?>
				<td><?php echo $record->emb_libelle ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->rad_id?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="3">Aucune emission bénévole.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>