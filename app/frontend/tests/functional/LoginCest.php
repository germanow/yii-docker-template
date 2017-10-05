<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\fixtures\AuthAssignmentFixture;


class LoginCest
{
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
    }

    protected function formParams($email, $password)
    {
        return [
            'LoginForm[email]' => $email,
            'LoginForm[password]' => $password,
            'LoginForm[verifyCode]' => 'testme'
        ];
    }

    public function checkEmpty(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('wrong@mail.com', 'wrong'));
        $I->seeValidationError('Incorrect email or password.');
    }
    
    public function checkValidLogin(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('goha@mail.com', 'password_0'));
        $I->see('Logout (goha)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
