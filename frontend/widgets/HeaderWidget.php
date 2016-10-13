<?php
namespace frontend\widgets;

use yii\base\Widget;
use Yii;

use common\models\Category;

class HeaderWidget extends Widget{

    function run(){
        $model = new Category();
        $date = $model->getCategorysByParent(1);
        $category = array();
        foreach($date as $c){
            $category[] = ['label' => $c->name, 'url' => ['adsense/index', 'category' => $c->name]];
        }
        return $this->render('@frontend/widgets/views/header.php',[
            'category' => $category,
        ]);
    }
}