<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $model */

?>

<?php $form = ActiveForm::begin([
    'action' => ['/orders'],
    'method' => 'get',
    'options' => [
        'class' => 'form-inline'
    ],
    'fieldConfig' => [
        'template' => "{input}",
        'options' => ['tag' => false],
    ],
]);

?>
<div class="input-group">

    <?= $form->field($model, 'search')->textInput(['maxlength' => 255, 'class' => 'form-control', 'placeholder' => 'Search Orders', 'name' => 'search'])->label(false) ?>

    <span class="input-group-btn search-select-wrap">

            <?= $form->field($model, 'search_type')->dropDownList([
                1 => 'Order ID',
                2 => 'Link',
                3 => 'Username',
            ], ['class' => 'form-control search-select', 'name' => 'search_type'])->label(false) ?>
            <?= Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', ['class' => 'btn btn-default']) ?>
         </span>
</div>

<?php ActiveForm::end(); ?>


