<?php
namespace backend\models;

use Yii;
use common\models\User;
use common\models\LoginForm;

/**
 * Login form
 */
class BackendLoginForm extends LoginForm
{
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email, User::ROLE_ADMIN);
        }

        return $this->_user;
    }
}
