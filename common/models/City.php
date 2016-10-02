<?php
namespace common\models;

use yii\db\ActiveRecord;

class City extends ActiveRecord{

    public static function tableName(){
        return '{{%city%}}';
    }
}