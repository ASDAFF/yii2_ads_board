<?php
namespace common\models;

use yii\db\ActiveRecord;

class UserInfo extends ActiveRecord{

    public static function tableName(){
        return '{{%user_info%}}';
    }


}