<?php
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Мои объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if(Yii::$app->session->hasFlash('AdsenseDeleted')): ?>
    <div class="alert">
        Объявление успешно Удалено
    </div>
<?php endif; ?>
<?php if(Yii::$app->session->hasFlash('AdsenseDeletedError')): ?>
    <div class="alert alert-error">
        Ошибка удаление
    </div>
<?php endif; ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        'category',
        'city',
        'cost',
        'state',
        'date_publish',
        [
            'label' => 'Картинка',
            'format' => 'raw',
            'value' => function($data){
                    return Html::img(Url::to('@web/img/'.$data->preview_img),[
                        'style' => 'width:80px; height:80px'
                    ]);
                },
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Действия',
            'headerOptions' => ['width' => '40px',],
            'template' => '{view} {delete}',
        ],
    ]
]); ?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              