<?php

use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Configuración';
?>
<div class="user-form container mb-5">
    <div class="lines-effect">
        <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="col">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="row">
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="e-profile">
                                <div class="row">
                                    <div class="col-12 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 140px;">
                                            <?php 
                                            $avatarImage = 'http://placehold.it/140';
                                            if(isset($model->profile_img) && !empty($model->profile_img))
                                                $avatarImage = $model->profile_img;
                                            ?>
                                            <img id="avatar-preview" src="<?= $avatarImage?>" alt="your image" style="max-width: 140px;max-height: 140px;" />
                                        </div>
                                        <div class="mt-2">
                                            <?= Html::hiddenInput('hidden_profile_img', $model->profile_img); ?>
                                            <?= $form->field($model, 'profile_img')->fileInput(['onchange'=>'readFileURL(this,"avatar-preview")', 'id' => 'avatar-file-input','class' => 'd-none'])->label(false) ?>
                                            <button class="btn btn-rounded btn-dark btn-select-profile-image" type="button">
                                                <i class="fa fa-fw fa-camera"></i>
                                                <span>Cambiar Foto</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width:855px;">
                                            <?php
                                            $bannerImage = 'http://placehold.it/1800x380';
                                            if(isset($model->banner_img) && !empty($model->banner_img))
                                                $bannerImage = $model->banner_img;
                                            ?>
                                            <img id="banner-preview" src="<?= $bannerImage?>" alt="your image" class="w-100" style="max-width: 855px;max-height: 140px;" />
                                        </div>
                                        <div class="mt-2">
                                            <?= Html::hiddenInput('hidden_banner_img', $model->banner_img); ?>
                                            <?= $form->field($model, 'banner_img')->fileInput(['onchange'=>'readFileURL(this,"banner-preview")', 'id' => 'banner-file-input','class' => 'd-none'])->label(false) ?>
                                            <button class="btn btn-rounded btn-dark btn-select-banner-image" type="button">
                                                <i class="fa fa-fw fa-camera"></i>
                                                <span>Cambiar Banner</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="" class="active nav-link">Configuración</a></li>
                                </ul>
                                <div class="tab-content pt-3">
                                    <div class="tab-pane active">
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->input('text', ['placeholder' =>
                                                        (isset($model->name) && !empty($model->name)) ? Html::encode($model->name) : "Escríbe tu nombre completo." ]) ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'disabled' => 'true']) ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <?= $form->field($model, 'description')->textarea(['rows' => '6', 'placeholder'=>
                                                            (isset($model->description) && !empty($model->description)) ? Html::encode($model->description) : "Escriba una descripción para el gimnasio..." ])->hint('0/320 Caracteres.') ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <?= $form->field($model, 'address')->textInput(['maxlength' => true])->input('text', ['placeholder' =>
                                                        (isset($model->address) && !empty($model->address)) ? Html::encode($model->address) : "Escriba la dirección." ]) ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true])->input('text', ['placeholder' =>
                                                        (isset($model->postal_code) && !empty($model->postal_code)) ? Html::encode($model->postal_code) : "Escriba el código postal.",'maxlength'=>5,'minlength'=>5, 'id' => 'postal_code']) ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <?php if(isset($model->provincia_id) && !empty($model->provincia_id)):?>
                                                            <?= $form->field($model, 'provincia_id')->dropDownList(['' => 'Select', $model->provincia_id => $model->getProvinciaName($model->provincia_id)], ['id' => 'provincia_id']); ?>
                                                        <?php else:?>
                                                            <?= $form->field($model, 'provincia_id')->dropDownList(['' => 'Select'], ['id' => 'provincia_id']); ?>
                                                        <?php endif;?>
                                                    </div>
                                                    <div class="col">
                                                        <?php if(isset($model->localidad_id) && !empty($model->localidad_id)):?>
                                                            <?= $form->field($model, 'localidad_id')->dropDownList($localidadesData, ['id' => 'localidad_id']); ?>
                                                        <?php else:?>
                                                            <?= $form->field($model, 'localidad_id')->dropDownList(['' => 'Select'], ['id' => 'localidad_id']); ?>
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 mb-3">
                                                        <div class="mb-2"><b>Cambiar contraseña</b></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <?= $form->field($model, 'oldPassword')->textInput()->input('password') ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <?= $form->field($model, 'password')->
                                                                widget(PasswordInput::classname(), [
                                                                        'pluginOptions' => [
                                                                                'showMeter' => true,
                                                                            'toggleMask' => false,
                                                                        ]]) ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <?= $form->field($model, 'passwordConfirm')->textInput()->input('password') ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <?= Html::submitButton('Guardar Cambios', ['class' => 'float-right btn btn-rounded btn-dark']) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<input type="hidden" id="get_provincia" value="<?php echo Yii::$app->request->baseUrl.'/site/getprovincia' ?>">
<input type="hidden" id="get_localidades" value="<?php echo Yii::$app->request->baseUrl.'/site/getlocalidades' ?>">
<input type="hidden" id="csrf_token" value="<?=Yii::$app->request->getCsrfToken()?>">
<?php 
 $script = <<< JS
    $(document).ready(function(){
        $(document).on("click", ".btn-select-profile-image", function(){
            $("#avatar-file-input").trigger("click");
        });
        $(document).on("click", ".btn-select-banner-image", function(){
            $("#banner-file-input").trigger("click");
        });
        $(document).on("change", "#provincia_id", function(){
            if($(this).val())
            {
                $.ajax({
                    type: 'post',
                    url: $("#get_localidades").val(),
                    data:{provincia_id:$("#provincia_id").val(),_csrf:$("#csrf_token").val()},
                    success: function(response){
                        $("#localidad_id").html(response);
                    }
                });
            }
        });
        $(document).on("keyup", "#postal_code", function(){
            if($(this).val().toString().length >= 2)
            {
                var zipcode = $(this).val().substring(0, 2)
                $.ajax({
                    type: 'post',
                    url: $("#get_provincia").val(),
                    data:{zipcode:zipcode,_csrf:$("#csrf_token").val()},
                    success: function(response){
                        $("#provincia_id").html(response);
                    }
                });
            }
        });
    });
 JS;
 $this->registerJs($script);
 ?>
<script>

//show uploaded image preview
function readFileURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id)
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>