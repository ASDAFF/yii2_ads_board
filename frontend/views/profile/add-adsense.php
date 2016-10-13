<?php
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use common\models\Category;
use common\models\City;
?>

<div class="form">
    <?php
    $form = ActiveForm::begin([
        'id' => 'AdsenseForm',
        'options' => ['enctype' => 'multipart/form-data']
    ])
    ?>
    <?= $form->field($model,'title'); ?>
    <?= $form->field($model,'description')->textarea(['rows' => 6,'cols' => 40]); ?>
    <?= $form->field($model,'state'); ?>
    <?= $form->field($model,'cost'); ?>
    <?= $form->field($model,'preview_img')->fileInput(); ?>
    <?= $form->field($model,'img_list[]')->fileInput(['multiple' => true]); ?>
    <?=
    $form->field($model,'category_id')->dropDownList(
        Category::find()->select('name')->where(['>','parent_id',0])->indexBy('id')->column(),
        ['prompt' => 'Выбор категории']
    );
    ?>
    <?=
    $form->field($model,'city_id')->dropDownList(
        City::find()->select('name')->indexBy('id')->column(),
        ['prompt' => 'Выбор города']

    );
    ?>
    <?= BaseHtml::submitButton('Добавить объявление',['class' => 'btn btn-primary']) ?>
    <?php
    ActiveForm::end();
    ?>
</div>