<?php
namespace frontend\controllers;

use common\models\City;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\Pagination;

use common\models\Adsense;

class AdsenseController extends Controller{

    public function actionIndex(){
        $adsense = new Adsense();
        //$city = new City();
        //$list = $city->fin
        $list = $adsense->getAdsenseList();

        $pagination = new Pagination(
            [
                'defaultPageSize' => 10,
                'totalCount' => $list->count(),
            ]
        );

        $list = $list
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index',[
            'list' => $list,
            'pagination' => $pagination,
        ]);
    }

    public function actionCurrentAdsense($id){
        $adsense = new Adsense();
        $item = $adsense->getAdsense($id);
        return $this->render('current-adsense',[
            'adsense' => $item,
        ]);
    }
}