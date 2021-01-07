<?php

namespace frontend\tests\functional;

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
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Debes introducir un nombre de usuario.');
        $I->seeValidationError('Debes introducir un correo electrónico.');
        $I->seeValidationError('Debes introducir una contraseña.');
        $I->seeValidationError('Debes confirmar tu contraseña.');

    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'SignupForm[username]'  => 'tester',
                'SignupForm[email]'     => 'ttttt',
                'SignupForm[password]'  => 'tester_password',
                'SignupForm[passwordConfirm]'  => 'tester_password',
        ]
        );
        $I->dontSee('Debes introducir un nombre de usuario.', '.help-block');
        $I->dontSee('Debes introducir un correo electrónico.', '.help-block');
        $I->dontSee('Debes confirmar tu contraseña.', '.help-block');
        $I->see('Correo electrónico is not a valid email address.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'tester',
            'SignupForm[email]' => 'tester.email@example.com',
            'SignupForm[password]' => 'tester_password',
            'SignupForm[passwordConfirm]'  => 'tester_password',
        ]);

        $I->seeRecord('common\models\User', [
            'username' => 'tester',
            'email' => 'tester.email@example.com',
            'status' => \common\models\User::STATUS_INACTIVE
        ]);

        $I->seeEmailIsSent();
        $I->see('Muchas gracias por registrarte.
    Hemos enviado a tu email un correo de verificación.
    Este proceso puede tardar varios minutos, 
                si todavía no lo has recibido compruebe su bandeja de spam, 
                o utilice este enlace.');
    }
}
