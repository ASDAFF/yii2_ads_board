<?php
namespace frontend\controllers;

use common\models\Image;
use Faker\Provider\DateTime;
use frontend\models\AdsenseForm;
use Yii;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use common\models\Adsense;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class ProfileController extends Controller{

    public function behaviors(){
        return[
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['my-adsense','add-adsense','delete','view','favorite'],
                        'allow' => 'true',
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get','post'],
                ]
            ]
        ];

    }

    public function actionMyAdsense(){
        $adsense = new Adsense();
        $dataProvider = new ActiveDataProvider([
            'query' => Adsense::find(),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        $user_id = Yii::$app->user->id;
        $list = $adsense->getAdsenseListByUserId($user_id);

        return $this->render('my-adsense',[
            'dataProvider' => $list,
        ]);
    }

    public function actionAddAdsense(){
        $model = new AdsenseForm();
        $image = new Image();

        $dir = Yii::getAlias('@frontend/web/img/');
        if(isset($_POST['AdsenseForm'])){
            $_POST['AdsenseForm']['user_id'] = Yii::$app->user->id;
            $_POST['AdsenseForm']['publish_status'] = 1;
            $_POST['AdsenseForm']['date_publish'] = date('Y-m-d H:i:s');
            $model->attributes = Yii::$app->request->post('AdsenseForm');
            if($model->save()){
                $model->img_list = UploadedFile::getInstances($model,'img_list');
                if($model->uploadList($model->id)){
                    echo 'successX1';
                }
                $model->preview_img = UploadedFile::getInstance($model,'preview_img');
                if(isset($model->preview_img)){
                    if($model->uploadOne($model->id)){
                        echo 'successX2';
                    }
                }
                return Yii::$app->getResponse()->redirect(['profile/my-adsense']);
            }
        }
        return $this->render('add-adsense',[
            'model' => $model,

        ]);
    }

    public function actionDelete($id = null){
        $adsense = Adsense::findOne($_GET['id']);

        if($adsense == null){
            Yii::$app->session->setFlash('AdsenseDeletedError');
            Yii::$app->getResponse()->redirect(['profile/my-adsense']);
        }
        $adsense->delete();

        Yii::$app->session->setFlash('AdsenseDeleted');
        Yii::$app->getResponse()->redirect(['profile/my-adsense']);
    }

    public function actionView(){
        $adsense = new Adsense();
        $data = $adsense->getAdsense($_GET['id']);

        return $this->render('view',[
            'data' => $data,
        ]);
    }

    public function actionFavorite(){
        $adsense = new Adsense();
        $data = $adsense->getAdsenseFavorite(Yii::$app->user->id);

        return $this->render('favorite',[
            'data' => $data,
        ]);
    }

}