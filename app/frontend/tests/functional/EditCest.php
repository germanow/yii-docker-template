<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\fixtures\AuthAssignmentFixture;
use common\classes\MyUploadedFile;

class EditCest
{
    protected $formId = '#form-edit';


    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'auth' => [
                'class' => AuthAssignmentFixture::className(),
                'dataFile' => codecept_data_dir() . 'auth.php'
            ],
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
        $I->amOnRoute('site/login');
        $I->submitForm('#login-form', $this->loginFormParams('goha@mail.com', 'password_0'));
    }
    
    protected function loginFormParams($email, $password)
    {
        return [
            'LoginForm[email]' => $email,
            'LoginForm[password]' => $password,
            'LoginForm[verifyCode]' => 'testme'
        ];
    }
    

    public function editAll(FunctionalTester $I)
    {
        $I->amOnRoute('user/edit');
        $I->see('Edit profile');
        $I->seeRecord('common\models\User', [
            'email' => 'goha@mail.com',
            'name' => 'goha',
        ]);
        $I->submitForm($this->formId, [     
            'EditForm[name]' => 'Not goha',
        ]);
        
        $I->seeRecord('common\models\User', [
            'email' => 'goha@mail.com',
            'name' => 'Not goha',
        ]);

        $I->seeCurrentUrlEquals('/user/my-profile');
    }
    
    public function editNothing(FunctionalTester $I)
    {
        $I->amOnRoute('user/edit');
        $I->see('Edit profile');
        $I->seeRecord('common\models\User', [
            'email' => 'goha@mail.com',
            'name' => 'goha',
        ]);
        $I->submitForm($this->formId, [
            'name' => ''
        ]);
        
        $I->seeRecord('common\models\User', [
            'email' => 'goha@mail.com',
            'name' => 'goha',
        ]);

        $I->seeCurrentUrlEquals('/user/my-profile');
    }
}
