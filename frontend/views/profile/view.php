<?php
use yii\widgets\DetailView;
$this->title = 'Мои объявления';
$this->params['breadcrumbs'][] = $this->title;
echo DetailView::widget([
    'model' => $data,
    'attributes' => [
        'title',
        'description',
        'category',
        'city',
        'state',
        'cost',
        'date_publish'

    ]
]);