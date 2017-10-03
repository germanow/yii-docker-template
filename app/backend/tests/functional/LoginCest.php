<?php

namespace backend\tests\functional;

use \backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\fixtures\AuthAssignmentFixture;

/**
 * Class LoginCest
 */
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
    }
    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Email', 'goha@mail.com');
        $I->fillField('Password', 'password_0');
        $I->fillField('Verify Code', 'testme');
        $I->click('login-button');
        $I->seeResponseCodeIs(200);
        $I->dontSee('Logout (goha)', 'form button[type=submit]');
        $I->seeLink('Login');
    }
    
    /**
     * @param FunctionalTester $I
     */
    public function loginAdmin(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Email', 'ivan@mail.com');
        $I->fillField('Password', 'password_0');
        $I->fillField('Verify Code', 'testme');
        $I->click('login-button');
        $I->seeResponseCodeIs(200);
        $I->see('Logout (ivan)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
    }
}
