<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

class RbacController extends Controller
{
    //Создаёт иерархию ролей RBAC в БД
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        //Проверяем существование роли, чтобы можно было повторно вызывать метод rbac/init при запуске докером
        if(!array_key_exists(User::ROLE_USER, $roles)){
            //Добавляем роль простого пользователя
            $user = $auth->createRole(User::ROLE_USER);
            $auth->add($user);
        }
        if(!array_key_exists(User::ROLE_ADMIN, $roles)){
            // Добавляем роль админа
            $admin = $auth->createRole(User::ROLE_ADMIN);
            $auth->add($admin);
            $auth->addChild($admin, $user);
        }
    }
    
    //Назначает роль admin
    public function actionAdminAssign($email){
        $auth = Yii::$app->authManager;
        $roleAdmin = $auth->getRole(User::ROLE_ADMIN);
        $user = User::findByEmail($email);
        if(isset($user)){
            $auth->assign($roleAdmin, $user->id);
        }else{
            echo 'Email ' . $email . ' does not exist.';
        }
    }
}