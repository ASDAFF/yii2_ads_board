<?php
namespace frontend\widgets;

use yii\base\Widget;
use Yii;
use common\models\Category;

class CategoryWidget extends Widget{

    function run(){
        $category = new Category();
        $items = $category->getCategoryList();
        return $this->render('@frontend/widgets/views/category.php',[
            'list' => $items,
        ]);
    }
}