<div>
	<h1 class="page-header">Emplacement</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<table class="table table-striped table-bordered">
		<thead>
		
			
		<th>libelle emplacement</th>
		<th>identifiant radio</th>
		<th>emp_plus egal a 1 si emission benevole sinon 0</th>
		<th>mail emplacement</th>
		
		</thead>
		<tbody>
		
		<?php foreach ($records as $record) : ?>
			<?php $record = (array)$record;?>
			<tr>
			<?php foreach($record as $field => $value) : ?>
				
				<?php if ($field != 'emp_id') : ?>
					<td><?php echo ($field == 'deleted') ? (($value > 0) ? lang('emplacement_true') : lang('emplacement_false')) : $value; ?></td>
				<?php endif; ?>
				
			<?php endforeach; ?>

			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>