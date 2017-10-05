<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
?>
<div class="container-fluid signup">
    <div class="container">
    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>
        <p style="text-align: center;">Please fill out the following fields to signup:</p>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
        
                <?= $form->field($model, 'photo')->fileInput() ?> 

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                    
                </fieldset>
           <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>
    
