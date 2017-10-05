<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class EditForm extends Model
{
    public $name;
    public $photo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'string', 'min' => 2, 'max' => 36],
            ['photo', 'image', 'skipOnEmpty' => true, 'extensions' => 'jpg'],
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function edit()
    {
        if (!$this->validate()) {
            return false;
        }
        
        $user = $this->getUser();
        
        $user->name = empty($this->name) ? $user->name: $this->name;
        
        if($this->photo){
            !YII_TEST_ENV ? $this->photo->deleteFileByHash($user->photo, 'jpg'):false;//Удаляем текущее фото
            $user->photo = $this->photo->getMD5();
            $this->photo->saveAs($this->photo->getFilePathWithSubdir());
        }
        if($user->save()){
            return true;
        }else{
            return false;
        }
    }
    
    public function getUser(){
        return Yii::$app->user->identity;
    }
}