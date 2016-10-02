<?php
namespace frontend\widgets;

use yii\base\Widget;
use Yii;

class HeaderWidget extends Widget{

    function run(){
        return $this->render('@frontend/widgets/views/header.php',[]);
    }
}