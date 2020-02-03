<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\ar\User;

class NewLoginForm extends Model {
    
    public $error;
    public $login;
    public $password;
    
    public function rules() {
        return [
            [['login', 'password'], 'required', 'message' => 'Обязательное поле']
        ];
    }
    
    /**
     * @return bool результат проверки
     */
    public function login() {
        $users = User::find()->where(['login' => $this->login])->all();
        if (count($users) > 0) {
            $user = $users[0];
            $hash = User::getPasswordHash($this->password);
            if ($user->password == $hash) {
                Yii::$app->user->login($user);
                $isGuest = Yii::$app->user->isGuest;
                return true;
            }
        }
        $this->error = 'Не найден пользователь с такими логином и паролем';
        return false;
    }
    
}