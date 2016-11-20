<?php
use yii\helpers\BaseHtml;
use yii\bootstrap\ActiveForm;

use common\models\City;
use common\models\Category;
?>
<?php // Задать свойство по умолчанию можно 'checked ' но нельзя 'ckecked' для chekbox ??? ?>

<div class="row">
    <div id="search-btn">
        <h6>Поиск</h6>
    </div>
    <div id="search">
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <div class="row">
        <div class="col-md-3 col-sm-4 col-md-offset-1 col-sm-offset-1">
            <?= $form->field($model,'searchQ'); ?>
        </div>

        <div class="col-md-3 col-sm-3">
            <?= $form->field($model,'city_id')->dropDownList(
            City::find()->select('name')->indexBy('id')->column(),
            ['prompt' => 'Вся Украина']
            ); ?>
        </div>

        <div class="col-md-3 col-sm-3">
            <?= $form->field($model,'category_id')->dropDownList(
            Category::find()->select('name')->where(['>', 'parent_id', 0])->indexBy('id')->column(),
            ['prompt' => 'Все категории']
            ); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-1 col-sm-offset-1">
            <?= $form->field($model,'searchInDesc')->checkbox(['check' => true, 'uncheck' => false]) ?>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model,'onlyFoto')->checkbox(['check' => true, 'uncheck' => false]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-1 col-sm-offset-1">
            <?= $form->field($model,'minCost'); ?>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model,'maxCost'); ?>
        </div>
        <?php // когда буду писать css вынести margin с опций ?>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <?= BaseHtml::submitButton('Поиск',['class' => 'btn btn-primary', 'name' => 'signup-button', 'style' => 'margin-top:23px']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>