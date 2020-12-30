<?php if(!empty($localidades)):?>
	<option value="">Select</option>
	<?php foreach($localidades as $localidade):?>
		<option value="<?= $localidade->id?>"><?= $localidade->nombre_localidad?></option>
	<?php endforeach;?>
<?php else:?>
	<option value="">Select</option>
<?php endif;?>