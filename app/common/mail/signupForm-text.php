<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$loginLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>
Congratulation, <?= $user->name ?>.

You have successfully registered

Go to login page: <?= $loginLink ?>
