<?php
use yii\helpers\BaseHtml;
use yii\helpers\Url;
//var_dump($adsense);
?>

<div class="row">
    <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="article">
            <h3><?= $adsense->title; ?></h3>
            <small>
                Дата: <?= $adsense->date_publish; ?>
                Цена: <?= $adsense->cost; ?>
                Город: <?= $adsense->city; ?>
                Номер объявления: <?= $adsense->id ?>
                <br>
                Автор: <?= $adsense->user_name; ?>
            </small>
            <?php if(!empty($adsense->images)){
                foreach($adsense->images as $img){
                echo BaseHtml::img('@web/img/' . $img->path, ['width' => 600, 'height' => 600, 'class' => 'img-responsive']);
                }
            }
            ?>
            <p><?= $adsense->description; ?></p>
        </div>
    </div>
</div>