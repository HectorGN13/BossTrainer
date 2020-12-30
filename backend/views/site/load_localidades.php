<?php if(!empty($localidades)):?>
	<option value="">Select</option>
	<?php foreach($localidades as $localidad):?>
		<option value="<?= $localidad->id?>"><?= $localidad->nombre_localidad?></option>
	<?php endforeach;?>
<?php else:?>
	<option value="">Select</option>
<?php endif;?>