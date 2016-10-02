<?php
namespace common\models;

use yii\db\ActiveRecord;

class Image extends ActiveRecord{

    public static function tableName(){
        return '{{%images%}}';
    }
}