<?php
use yii\grid\GridView;

use yii\helpers\Html;
?>

<?= GridView::widget([
    'dataProvider' => $data,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        'category',
        'city',
        'cost',
        'state',
        'date_publish',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Перейти',
            'template' => '{link}',
            'buttons' => [
                'link' => function($url,$model,$key){
                        return Html::a('Acton',['adsense/current-adsense','id' => $model->id] );
                    },
            ]

        ]

    ]

]);
?>