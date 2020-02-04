<?php

namespace app\models\ar;

use yii\db\ActiveRecord;

class Contact extends ActiveRecord {
    
    public function rules() {
        return [
            [['fio', 'phone', 'email'], 'safe'],
            [['fio'], 'required', 'message' => 'Обязательное поле'],
            [['fio', 'phone', 'email'], 'string', 'max' => 250, 'message' => 'Значение должно быть строкой', 'tooLong' => 'не более {max} символов'],
            [['email'], 'email', 'message' => 'Введите корректный email-адрес'],
            [['phone'], 'match', 'pattern' => '/[0-9\-\(\)+\s]+/', 'message' => 'Введите корректный номер телефона']
        ];
    }
        
    public static function tableName() {
        return '{{contact}}';
    }
    
}

