<?php
use yii\widgets\LinkPager;

$this->title = 'Список объявлений';
$this->params['breadcrumbs'][] = $this->title;
//var_dump($list);
?>
<div class="row">
    <div class="col-md-9 col-sm-9 col-xs-12">
    <p><?= $sort->link('cost') . ' | ' . $sort->link('date_publish'); ?></p>
<?php
foreach ($list as $item){
    echo $this->render('shortView',[
        'item' => $item,
    ]);
}

?>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">

    </div>
</div>

<?= LinkPager::widget(['pagination' => $pagination]); ?>