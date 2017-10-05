<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $email;
    public $photo;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'string', 'min' => 2, 'max' => 36],
            ['password', 'string', 'min' => 6, 'max' => 64],
            
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            
            ['photo', 'image', 'skipOnEmpty' => false, 'extensions' => 'jpg'],
            
            [['name', 'email', 'photo', 'password'], 'required'],
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return false;
        }
        
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $user->photo = $this->photo->getMD5();
        $this->photo->saveAs($this->photo->getFilePathWithSubdir());        

        if($user->save()){
            if($this->sendEmail($user)){
                //Присваиваем роль обычного пользователя
                $auth = Yii::$app->authManager;
                $roleUser = $auth->getRole(User::ROLE_USER);
                $auth->assign($roleUser, $user->id);
                return true;
            }else{
                $user->delete();
                return false;
            }
        }else{
            return false;
        }
    }
    
    /**
     * Sends an email with password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'signupForm-html', 'text' => 'signupForm-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['notifyEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Congratulations')
            ->send();
    }
}
