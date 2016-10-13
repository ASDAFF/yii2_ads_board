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

    public function getCategorysByParent($id){
        return $this
            ->find()
            ->select('name')
            ->where(['parent_id' => $id])
            ->orderBy('name DESC')
            ->all();
    }

    public function getCategoryList(){
        $categorys = Category::find()
            ->all();

        $date = array();
        $i = 0;

        foreach($categorys as $cat){
            if($cat->parent_id == 0){
                $date[$i][] = $cat;
                $i++;
            }
        }

        foreach($categorys as $cat){
            for($i=0; $i < count($date);$i++){
                if($date[$i][0]->id == $cat->parent_id){
                    $date[$i][] = $cat;
                }
            }
        }

        return $date;

    }

}