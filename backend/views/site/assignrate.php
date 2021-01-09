<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
$this->title = 'Asignar tarifa';
?>
<div class="gymuser-index">
	<div class="board-list container mb-5">
		<div class="lines-effect">
            <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="row">
        	<div class="col-12">
        		<?php $form = ActiveForm::begin(); ?>
	        		<?= $form->field($model, 'user_id')->hiddenInput(['id'=> 'user_id', 'value' => $id, 'readonly' => true])->label(false);?>
                    <?= $form->field($model, 'type')->dropDownList($items, ['prompt'=>'Selecciona el tipo de tarifa']); ?>
	        		<?php
			            echo $form->field($model, 'start_date')->widget(DatePicker::classname(), [
			                'name' => 'start_date',
			                'type' => DatePicker::TYPE_INPUT,
			                'value' => date('d-M-Y'),
			                'model' => $model,
			                'options' => [
			                    'placeholder' => 'Ingrese la fecha de inicio',
			                ],
			                'pluginOptions' => [
			                    'autoclose'=>true,
			                    'format' => 'dd-M-yyyy',
			                ]
			            ]);
		            ?>
		            <?php
			            echo $form->field($model, 'end_date')->widget(DatePicker::classname(), [
			                'name' => 'end_date',
			                'type' => DatePicker::TYPE_INPUT,
			                'value' => date('d-M-Y'),
			                'model' => $model,
			                'options' => [
			                    'placeholder' => 'Ingrese la fecha de finalización',
			                ],
			                'pluginOptions' => [
			                    'autoclose'=>true,
			                    'format' => 'dd-M-yyyy',
			                ]
			            ]);
		            ?>
		            <div class="d-flex justify-content-center form-group">
		                <?= Html::submitButton('Guardar', ['class' => 'btn btn-lg btn-rounded btn-dark-blue']) ?>
		            </div>
	            <?php ActiveForm::end(); ?>
        	</div>
        </div>
	</div>
</div>