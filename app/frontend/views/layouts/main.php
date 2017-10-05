<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="<?php echo Yii::$app->params['domainImage'] . 'favicon.ico' ?>" type="image/x-icon" />
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <header class="header">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="container">
                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                      <!--   <div style="display: block;">Hello</div> -->
                        <a class="navbar-brand" href="<?= Url::to(['/site/index']) ?>">
                          <?= Html::img(Yii::$app->params['domainImage'] . 'favicon.ico'); ?>
                          <p>My company</p>
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <!-- <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a>
                            </li>
                        </ul> -->
                        <ul class="nav navbar-nav navbar-right">
                            <li><?= Html::a('Home', Url::to(['/site/index'])); ?></li>
                          <li><?= Html::a('About', Url::to(['/site/about'])); ?></li>
                          <li><?= Html::a('Contact', Url::to(['/site/contact'])); ?></li>
                          <?php
                              if (Yii::$app->user->isGuest) {
                                  echo '<li>'; 
                                  echo Html::a('Sign Up', Url::to(['/site/signup'])); 
                                  echo '</li>';
                                  echo '<li>'; 
                                  echo Html::a('Login', Url::to(['/site/login'])); 
                                  echo '</li>';
                              } else {

                                  echo '<li>'; 
                                  echo Html::a('My profile', Url::to(['/user/my-profile'])); 
                                  echo '</li>';

                                  echo '<li class="face">';
                                  echo '<div class="image-wrap">'; 
                                  echo Html::img(Yii::$app->user->identity->getPhotoLink(), ['height' => '40px', 'width' => '40px', 'vspace' => '5px']); 
                                  echo '</div>';
                                  echo '</li>';

                                  echo '<li class="logout-li">'; 
                                  echo Html::beginForm(['/site/logout'], 'post');
                                  echo Html::submitButton(
                                      'Logout (' . Yii::$app->user->identity->name . ')',
                                      ['class' => 'btn btn-link logout']
                                  );
                                  echo Html::endForm();
                                  echo '</li>';
                       
                              }
                          ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- Brand and toggle get grouped for better mobile display -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>

    <main>
        <?= Alert::widget() ?>
        <?= $content ?>
    </main>

<footer>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                  <div class="rw-ui-container"></div>
                    <div class="col-lg-4 col-md-4 col-sm-4"></div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        Copyright &copy
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4"></div>
                </div>
            </div>
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
