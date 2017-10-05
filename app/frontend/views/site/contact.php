<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid contact">
    <div class="container">
    <div class="row">
       <div class="site-contact">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
            </p>
        </div>
    </div>
</div>
</div>

<div class="container-fluid">
  <div class="container">
    <div class="row">
        <div class="contact-form">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'placeholder' => 'Name']) ?>

                <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-mail']) ?>

                <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject']) ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6])->textInput(['placeholder' => 'Body']) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div>{image}</div><div>{input}</div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'button-cust', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>  
</div>

