<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Adsense;
use yii\data\Pagination;

class MainController extends Controller{

    public function actionAdsense(){
        $adsense = new Adsense();
        //$list = $category::find()->all();
        $list = $adsense->getAdsenseList();

        $pagination = new Pagination(
            [
                'defaultPageSize' => 2,
                'totalCount' => $list->count(),
            ]
        );

        $list = $list
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',
            [
                'list' => $list,
            ]);
    }
}