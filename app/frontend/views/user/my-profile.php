<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container-fluid">
    <div class="container">
        <div class="row">
            <p><?= Html::a('Edit profile', ['user/edit'], ['class' => 'btn btn-success']) ?>
            </p>
            <div class="wrapper col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
               <div class="my-profile">
                <div class="my-profile__name">
                    <p><?= $user->name ?></p>
                </div>
                <div class="my-profile__name">
                    <p><?= $user->email ?></p>
                </div>
               <div class="my-profile__photo">
                <?= Html::img(Yii::$app->user->identity->getPhotoLink()); ?>
                </div> 
            </div>
            </div> 
            </div>
        </div>
    </div>
</div>



    
