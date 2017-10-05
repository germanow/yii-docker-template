<?php

namespace frontend\tests\functional;

use Yii;
use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Signup', 'h1');
        $I->see('Please fill out the following fields to signup:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Email cannot be blank.');
    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupForm[name]'  => 'tester',
            'SignupForm[email]'     => 'ttttt',
        ]
        );
        $I->dontSee('name cannot be blank.', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $email = 'tester.email@example.com';
        $I->attachFile('input[id="signupform-photo"]', 'photo.jpg');
        $I->submitForm($this->formId, [
            'SignupForm[name]' => 'tester',
            'SignupForm[email]' => $email,
            'SignupForm[password]' => 'password_0',
        ]);
        
        $I->seeRecord('common\models\User', [
            'name' => 'tester',
            'email' => $email,
            'photo' => '1995c0ea1de4292e35d19a75166680fc',
        ]);

        $emailMessage = $I->grabLastSentEmail();
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey($email);
        expect($emailMessage->getFrom())->hasKey(Yii::$app->params['notifyEmail']);
        expect($emailMessage->toString())->contains('tester');
        $I->seeCurrentUrlEquals('/site/login');
    }
}
