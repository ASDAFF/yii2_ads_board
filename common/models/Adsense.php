<?php
namespace common\models;
use yii\data\ActiveDataProvider;
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
    public $ads_url;
    public $detail_imgs = array();
    public $city_check;

    public static function tableName() {
        return '{{%adsense}}';
    }

   public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
   }

    public function getUserInfo(){
        return $this->hasOne(UserInfo::className(), ['id' => 'user_id']);
    }

    public function getCity(){
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public function getImage(){
        return $this->hasOne(Image::className(), ['ads_id' => 'id']);
    }
    public function getImages(){
        return $this->hasMany(Image::className(), ['ads_id' => 'id']);
    }
    public function getFavorite(){
        return $this->hasMany(Favorite::className(), ['ads_id' => 'id']);
    }
    /*
    public function rules(){
        return[
            [['title','description','category_id','city_id','user_id','publish_status'], 'required'],
        ];
    }
    */

    public function attributeLabels(){
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'category_id' => 'Категория',
            'city_id' => 'Город'
        ];
    }


    public function getAdsenseList(){

        return Adsense::find()
            ->joinWith(['city','category','image'])
            ->select(['adsense.title','adsense.state', 'adsense.cost','adsense.date_publish',
            'adsense.id','city' => 'city.name','category' => 'category.name', 'preview_img' => 'images.path'])
            ->where(['publish_status' => 1]);
    }

    public function getAdsense($id){
        return Adsense::find()
            ->joinWith(['userInfo','category','image','city','images'])
            ->select(['adsense.title', 'adsense.state', 'adsense.cost', 'adsense.date_publish', 'adsense.id',
            'user_name' => 'user_info.contact_name', 'city' => 'city.name', 'category' => 'category.name',
            'preview_img' => 'images.path', 'telephon_number' => 'user_info.telephon_number',
            'user_skype' => 'user_info.skype', 'adsense.description', ])
            ->where(['adsense.id' => $id])
            ->one();
    }

    public function getAdsenseByCategory($category){
        $category_id = Category::find()
            ->select('category.id')
            ->where(['category.name' => $category])
            ->one();

        return Adsense::find()
            ->joinWith(['city','category','image'])
            ->select(['adsense.title','adsense.state', 'adsense.cost','adsense.date_publish',
                'adsense.id','city' => 'city.name','category' => 'category.name', 'preview_img' => 'images.path'])
            ->where(['adsense.category_id' => $category_id->id]);
    }

    public function getAdsenseFavorite($user_id){
        $favorite = Favorite::find()
            ->select('favorite.ads_id')
            ->where(['favorite.user_id' => $user_id])
            ->all();
        $searchD = [];
        foreach($favorite as $data){
            $searchD[] = $data->ads_id;
        }
        $data = new ActiveDataProvider([
            'query' => Adsense::find()
                    ->joinWith(['city','category','image'])
                    ->select(['adsense.title','adsense.state', 'adsense.cost','adsense.date_publish',
                        'adsense.id','city' => 'city.name','category' => 'category.name', 'preview_img' => 'images.path'])
                    ->where(['adsense.id' => $searchD]),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $data;

    }

    public function getAdsenseListByUserId($id){
        $data = new ActiveDataProvider([
            'query' => Adsense::find()
                    ->joinWith(['city','category','image'])
                    ->select(['adsense.title','adsense.state', 'adsense.cost','adsense.date_publish',
                        'adsense.id','city' => 'city.name','category' => 'category.name', 'preview_img' => 'images.path'])
                    ->where(['adsense.user_id' => $id]),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $data;
    }

    public function searchArticles($params){
        $articles = Adsense::find()
            ->joinWith(['city','category','image'])
            ->select(['adsense.title','adsense.state', 'adsense.cost','adsense.date_publish',
            'adsense.id','city' => 'city.name','category' => 'category.name', 'preview_img' => 'images.path'])
            ->where(['publish_status' => 1])
            ->andWhere(['like','title',$params['searchQ']]);

        if($params['city_id'] != null){
            $articles = $articles->andWhere(['adsense.city_id' => $params['city_id']]);
        }

        if($params['category_id'] != ""){
            $articles = $articles->andWhere(['adsense.category_id' => $params['category_id']]);
        }

        if($params['onlyFoto'] == 1){
            $articles = $articles->andWhere(['is not', 'images.path', null]);
        }

        if($params['minCost'] != null){
            $articles = $articles->andWhere(['>', 'cost', $params['minCost'] - 1]);
        }

        if($params['maxCost'] != null){
            $articles = $articles->andWhere(['<', 'cost', $params['maxCost']]);
        }

        return $articles;
    }

}