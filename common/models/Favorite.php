<?php
namespace common\models;

use yii\db\ActiveRecord;

class Favorite extends ActiveRecord{

    public static function tableName(){
        return '{{%favorite%}}';
    }
}