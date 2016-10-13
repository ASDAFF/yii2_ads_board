<?php
namespace frontend\widgets;
use Yii;
use yii\base\Widget;
use frontend\models\SearchForm;
use common\models\Adsense;
use yii\helpers\Url;

class SearchWidget extends Widget{

    public function run(){

        $model = new SearchForm();
        $adsense = new Adsense();
        if($_POST != null){
            $data = $_POST['SearchForm'];

            Yii::$app->getResponse()->redirect(Url::to(['adsense/search','data' => $data]));
        }


        return $this->render('@frontend/widgets/views/widget_search',[
            'model' => $model,
        ]);
    }
}