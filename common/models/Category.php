<?php
namespace common\models;
use yii\db\ActiveRecord;
use common\models\Adsense;
class Category extends ActiveRecord{

    public static function tableName(){
        return '{{%category}}';
    }


    public function getAdsense()
    {
        return $this->hasMany(Adsense::className(), ['category_id' => 'id']);
    }

}