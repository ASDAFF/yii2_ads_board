<?php
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;
use common\models\Category;
use common\models\City;
?>

<div class="form">
    <?php
        $form = ActiveForm::begin([
            'id' => 'Adsense'
        ])
    ?>
    <?= $form->field($model,'title'); ?>
    <?= $form->field($model,'description')->textarea(['rows' => 6,'cols' => 40]); ?>
    <?=
        $form->field($model,'category_id')->dropDownList(
          Category::find()->select('name')->where(['>','parent_id',0])->indexBy('id')->column(),
            ['promt' => 'Select category']
        );
    ?>
    <?=
        $form->field($model,'city_id')->dropDownList(
            City::find()->select('name')->indexBy('id')->column(),
            ['promt' => 'Select city']

        );
    ?>
    <?= $form->field($model,'city_check')->checkbox(['value' => 1, 'label' => 'Город по умолчанию']); ?>
    <?= BaseHtml::submitButton('Добавить объявление',['class' => 'btn btn-primary']) ?>
    <?php
        ActiveForm::end();
    ?>
</div>