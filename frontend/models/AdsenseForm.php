<?php
namespace frontend\models;

use common\models\Adsense;
use common\models\Image;
use Yii;

class AdsenseForm extends Adsense{
    public $img_list = [];

    public function rules(){
        return [
            [['title', 'description', 'category_id', 'city_id', 'user_id', 'publish_status', 'cost', 'state'],'required'],
            ['preview_img','file','extensions' => 'png, jpg'],
            ['img_list', 'file', 'extensions' => 'png, jpg', 'maxFiles' => 3],
            ['cost', 'integer'],
            ['date_publish','date','format'=>'yyyy-MM-dd HH:mm:ss']
        ];
    }

    public function attributeLabels(){
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'state' => 'Состояние',
            'cost' => 'Стоимость',
            'preview_img' => 'Основное изображение',
            'img_list' => 'Дополнительные изображения',
            'category_id' => 'Категории',
            'city_id' => 'Город'
        ];
    }

    public function uploadList($adsense_id){
        if($this->validate()){
            $dir = Yii::getAlias('@frontend/web/img/');
            $dir = $dir . Yii::$app->user->id . '/';
            if(!file_exists($dir)){
                mkdir($dir,'0777');
            }
            foreach($this->img_list as $file){
                $img = new Image();
                $file->saveAs($dir . $file->baseName . '.' . $file->extension);
                $img->path = $file->baseName . '.' . $file->extension;
                $img->ads_id = $adsense_id;
                $img->is_preview = 0;
                $img->save();
            }
        }
    }
    public function uploadOne($adsense_id){
        if($this->validate()){
            $dir = Yii::getAlias('@frontend/web/img/');
            $dir = $dir . Yii::$app->user->id . '/';
            if(!file_exists($dir)){
                mkdir($dir,'0777');
            }
            $img = new Image();
            $file = $this->preview_img;
            $file->saveAs($dir . $file->baseName . '.' . $file->extension);
            $img->path = Yii::$app->user->id. '/' . $file->baseName . '.' . $file->extension;
            $img->ads_id = $adsense_id;
            $img->is_preview = 1;
            $img->save();


        }
    }
}