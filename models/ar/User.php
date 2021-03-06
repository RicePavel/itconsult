<?php

namespace app\models\ar;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface {
    
    public function rules() {
        return [
            [['login', 'password'], 'safe'],
            [['login', 'password'], 'required', 'message' => 'Обязательное поле'],
            [['login'], 'unique', 'message' => 'Такой логин уже есть в системе, введите другое значение'],
            [['login', 'password'], 'string', 'length' => [3, 250], 'message' => 'Значение должно быть строкой', 'tooLong' => 'не более {max} символов', 'tooShort' => 'не менее {min} символов']
        ];
    }
    
    public function getFavorites() {
        return $this->hasMany(Favorite::className(), ['user_id' => 'user_id']);
    }
    
    public function getFavoriteContacts() {
        return $this->hasMany(Contact::className(), ['contact_id' => 'contact_id'])->via('favorites');
    }
    
    public function registration() {
        $this->password = self::getPasswordHash($this->password);
        return $this->save();
    }
    
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($this->isNewRecord) {
            $this->auth_key = \Yii::$app->security->generateRandomString();
        }
        return true;
    }
    
    public static function getPasswordHash($password) {
        return md5($password);
    }
    
    public static function tableName() {
        return '{{user}}';
    }
    
    public function getAuthKey() {
        return $this->auth_key;
    }

    public function getId() {
        return $this->user_id;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

}