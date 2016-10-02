<?php
use yii\helpers\BaseHtml;
?>
<div>
    <p><?= $item->title; ?></p>
    <p><?= $item->state; ?></p>
    <p><?= $item->cost; ?></p>
    <p><?= $item->city_id ?></p>
    <p><?= $item->category->text; ?></p>
</div>