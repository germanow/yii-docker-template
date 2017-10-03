<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\classes\MyUploadedFile;
use common\models\EditForm;
use common\models\User;

/**
 * Site controller
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['my-profile', 'edit', 'my-qr'],
                'rules' => [
                    [
                        'actions' => ['my-profile', 'edit', 'my-qr'],
                        'allow' => true,
                        'roles' => [User::ROLE_USER],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionMyProfile()
    {
        $user = Yii::$app->user->identity;
        return $this->render('my-profile', [
            'user' => $user,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionEdit()
    {
        $model = new EditForm();
        $user = Yii::$app->user->identity;
        if ($model->load(Yii::$app->request->post())) {
            $model->photo = MyUploadedFile::getInstance($model, 'photo');
            if ($model->edit()) {
                $this->redirect(['user/my-profile']);
            }
        }

        return $this->render('edit', [
            'model' => $model,
            'user' => $user,
        ]);
        
    }
    /**
     * Displays my-qr page.
     *
     * @return mixed
     */
    public function actionMyCard()
    {
        return $this->render('my-card');
    }
}
