<div class="admin-box">
	<h3>Style</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($this->auth->has_permission('Style.Developer.Delete') && isset($records) && is_array($records) && count($records)) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>couleur du style de musique</th>
					<th>libelle du style de musique</th>
				</tr>
			</thead>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<tfoot>
				<?php if ($this->auth->has_permission('Style.Developer.Delete')) : ?>
				<tr>
					<td colspan="3">
						<?php echo lang('bf_with_selected') ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete') ?>" onclick="return confirm('<?php echo lang('style_delete_confirm'); ?>')">
					</td>
				</tr>
				<?php endif;?>
			</tfoot>
			<?php endif; ?>
			<tbody>
			<?php if (isset($records) && is_array($records) && count($records)) : ?>
			<?php foreach ($records as $record) : ?>
				<tr>
					<?php if ($this->auth->has_permission('Style.Developer.Delete')) : ?>
					<td><input type="checkbox" name="checked[]" value="<?php echo $record->sty_id ?>" /></td>
					<?php endif;?>
					
				<?php if ($this->auth->has_permission('Style.Developer.Edit')) : ?>
				<td><?php echo anchor(SITE_AREA .'/developer/style/edit/'. $record->sty_id, '<i class="icon-pencil">&nbsp;</i>' .  $record->sty_couleur) ?></td>
				<?php else: ?>
				<td><?php echo $record->sty_couleur ?></td>
				<?php endif; ?>
			
				<td><?php echo $record->sty_libelle?></td>
				</tr>
			<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="3">No records found that match your selection.</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
</div>