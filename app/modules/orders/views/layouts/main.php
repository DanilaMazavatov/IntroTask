<?php

/** @var yii\web\View $this */
/** @var yii\web\View $content */
/** @var yii\web\View $pages */
/** @var yii\web\View $model */

use app\assets\AppAsset;

$language_change = Yii::$app->language == 'en' ? "ru" : "en";

?>

<?php AppAsset::register($this); ?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title ?></title>
    <style>
        .label-default{
            border: 1px solid #ddd;
            background: none;
            color: #333;
            min-width: 30px;
            display: inline-block;
        }
    </style>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>

<?=
    $this->render('navbar', [
        'language_change' => $language_change
    ]);
?>

<div class="container-fluid">

    <?= $this->render('filtration'); ?>

    <?= $content ?>

</div>

<?php $this->endBody(); ?>
</body>
<html>
<?php $this->endPage(); ?>
