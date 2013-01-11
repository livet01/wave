<div>
	<h1 class="page-header">Emplacement</h1>
</div>

<br />

<?php if (isset($records) && is_array($records) && count($records)) : ?>
				
	<table class="table table-striped table-bordered">
		<thead>
		
			
		<th>Libelle de l'Emplacement</th>
		<th>Identifiant Radio : 1</th>
		<th>Emission Spéciale : 1, En Attente : 2, Sinon : 0</th>/th>
		<th>Email de l'Emplacement</th>
		
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