<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$loginLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>
<div class="password-reset">
    <p>Congratulation, <?= Html::encode($user->name) ?>.</p>

    <p>You have successfully registered</p>

    <p>Go to login page: <?= Html::a(Html::encode($loginLink), $loginLink) ?></p>
</div>
