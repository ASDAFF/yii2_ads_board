<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Adsense;

class SearchForm extends Model{

    public $searchQ;
    public $city_id;
    public $category_id;
    public $searchInDesc;
    public $onlyFoto;
    public $minCost;
    public $maxCost;

    public function rules(){

        return [
            ['searchQ','trim'],
            [['minCost','maxCost'],'number','message' => 'Только числовые поля']
        ];
    }

    public function attributeLabels(){
        $fields = [
            'searchQ' => 'Поисковой запрос',
            'city_id' => 'Город',
            'category_id' => 'Категория',
            'searchInDesc' => 'Поиск в описании',
            'onlyFoto' => 'Только с фото',
            'minCost' => 'Минимальная стоимость',
            'maxCost' => 'Максимальная стоимость',
        ];

        return $fields;
    }

}