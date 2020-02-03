<?php

namespace app\models\ar;

use yii\db\ActiveRecord;

class Favorite extends \yii\db\ActiveRecord {
    
    public static function tableName() {
        return '{{favorite}}';
    }
    
}
