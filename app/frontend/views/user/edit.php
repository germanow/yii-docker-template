<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Edit profile';
?>
<div class="container-fluid">
    <div class="container">
        <div class="row">
        <div class=" edit">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(['id' => 'form-edit']); ?>
            
                <?= $form->field($model, 'name')->input('text', ['value' => $user->name])->textInput(['placeholder' => 'name']) ?>
            
                <?= $form->field($model, 'photo')->fileInput() ?> 
            
            <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'button-cust', 'name' => 'submit-button']) ?>
                </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>

