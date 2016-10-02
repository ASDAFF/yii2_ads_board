<?php
namespace common\models;
use yii\db\ActiveRecord;
use common\models\Category;
use common\models\User;
use common\models\UserInfo;
use common\models\City;
use common\models\Image;
use Yii;

class Adsense extends ActiveRecord{

    public $user_name;
    public $telephon_number;
    public $user_skype;
    public $city;
    public $category;
    public $preview_img;
    public static function tableName() {
        return '{{%adsense}}';
    }

   public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
   }
    /*
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    */

    public function getUserInfo(){
        return $this->hasOne(UserInfo::className(), ['id' => 'user_id']);
    }

    public function getCity(){
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public function getImage(){
        return $this->hasOne(Image::className(), ['ads_id' => 'id']);
    }


    public function getAdsenseList(){

        return Adsense::find()
            ->joinWith(['city','category','image'])
            ->select(['adsense.title','adsense.state', 'adsense.cost','adsense.date_publish',
            'adsense.id','city' => 'city.name','category' => 'category.name', 'preview_img' => 'images.path'])
            ->where('publish_status = 1')
            ->orderBy('date_publish DESC');
    }

    public function getAdsense($id){
        return Adsense::find()
            ->joinWith(['userInfo','category','image','city'])
            ->select(['adsense.title', 'adsense.state', 'adsense.cost', 'adsense.date_publish', 'adsense.id',
            'user_name' => 'user_info.contact_name', 'city' => 'city.name', 'category' => 'category.name',
            'preview_img' => 'images.path', 'telephon_number' => 'user_info.telephon_number',
            'user_skype' => 'user_info.skype', 'adsense.description'])
            ->where(['adsense.id' => $id])
            ->one();
    }
}