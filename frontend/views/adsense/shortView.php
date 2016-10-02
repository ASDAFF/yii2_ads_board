<?php
use yii\helpers\BaseHtml;
use yii\helpers\Url;

//var_dump($item);
?>
<div class="adsense">
    <h3><?= BaseHtml::a($item->title,['adsense/current-adsense', 'id' => $item->id]); ?></h3>
    <small>
        Дата: <?= $item->date_publish; ?>
        Цена: <?= $item->cost ?>
        Город: <?= $item->city; ?>
    </small><br>
    <?php
        if(!empty($item->preview_img)){
            echo BaseHtml::img('@web/img/' . $item->preview_img, ['width' => 140, 'height' => 140]);
        }else{
            echo BaseHtml::img('@web/img/admin/no-img.jpg', ['width' => 140, 'heigth' =>140]);
        }
    ?>
</div>

