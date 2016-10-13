<?php
namespace frontend\controllers;

use common\models\Category;
use common\models\City;
use frontend\models\SearchForm;
use Yii;
use yii\base\Exception;
use yii\data\Sort;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\Pagination;

use common\models\Adsense;
use yii\web\HttpException;

class AdsenseController extends Controller{

    public function actionIndex($category = null,$date = null){
        $adsense = new Adsense();
        $sort = new Sort([
            'attributes' => [
                'date_publish' => [
                    'asc' => ['date_publish' => SORT_ASC],
                    'desc' => ['date_publish' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Дата публикации',
                ],
                'cost' => [
                    'asc' => ['cost' => SORT_ASC],
                    'desc' => ['cost' => SORT_DESC],
                    'label' => 'Цена',
                ]
            ]
        ]);

        if($category != null){
            $list = $adsense->getAdsenseByCategory($category);
        }else{
            $list = $adsense->getAdsenseList();
        }

        $pagination = new Pagination(
            [
                'defaultPageSize' => 10,
                'totalCount' => $list->count(),
            ]
        );

        $list = $list->orderBy($sort->orders);

        $list = $list
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',[
            'list' => $list,
            'pagination' => $pagination,
            'sort' => $sort,
        ]);
    }

    public function actionSearch($date = null){
        $adsense = new Adsense();
        $model = new SearchForm();
        $data = $_GET['data'];
        $list = $adsense->searchArticles($data);

        $sort = new Sort([
            'attributes' => [
                'date_publish' => [
                    'asc' => ['date_publish' => SORT_ASC],
                    'desc' => ['date_publish' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Дата публикации',
                ],
                'cost' => [
                    'asc' => ['cost' => SORT_ASC],
                    'desc' => ['cost' => SORT_DESC],
                    'label' => 'Цена',
                ]
            ]
        ]);

        $pagination = new Pagination(
            [
                'defaultPageSize' => 10,
                'totalCount' => $list->count(),
            ]
        );

        $list = $list->orderBy($sort->orders);

        $list = $list
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',[
            'list' => $list,
            'pagination' => $pagination,
            'sort' => $sort,


        ]);
    }

    public function actionCurrentAdsense($id){
        $adsense = new Adsense();
        $item = $adsense->getAdsense($id);

        return $this->render('current-adsense',[
            'adsense' => $item,
        ]);
    }

    public function actionCategoryList(){
        $category = new Category();
        $list = $category->getCategoryList();

        return $this->render('category-list',[
            'list' => $list,
        ]);
    }


}