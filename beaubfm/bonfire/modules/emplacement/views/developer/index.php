<div class="admin-box">
	<h3>Emplacement</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Emplacement.Developer.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>libelle emplacement</th>
					<th>identifiant radio</th>
					<th>emp_plus egal a 1 si emission benevole sinon 0</th>
					<th>mail emplacement</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Emplacement.Developer.Delete')) : ?>
				<tr>
					<td colspan="5">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('emplacement_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Emplacement.Developer.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->emp_id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Emplacement.Developer.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/developer/emplacement/edit/'. $record->emp_id, '<i class="icon-pencil">&nbsp;</i>' .  $record->emp_libelle) ?></td>
				<?php else: ?>
				<td><?php echo $record->emp_libelle ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->rad_id?></td>
				<td><?php echo $record->emp_plus?></td>
				<td><?php echo $record->emp_mail?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="5">No records found that match your selection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>