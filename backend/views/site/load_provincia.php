<?php if(!empty($provincias)):?>
	<option value="">Select</option>
	<?php foreach($provincias as $provincia):?>
		<option value="<?= $provincia->id?>"><?= $provincia->nombre_provincia?></option>
	<?php endforeach;?>
<?php else:?>
	<option value="">Select</option>
<?php endif;?>