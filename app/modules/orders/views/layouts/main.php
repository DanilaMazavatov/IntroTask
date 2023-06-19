<?php

/** @var yii\web\View $this */
/** @var yii\web\View $content */
/** @var yii\web\View $pages */

use app\assets\AppAsset;

$language_change = Yii::$app->language == 'en' ? "ru" : "en";

?>

<?php //AppAsset::register($this); ?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/site.css">
    <?php $this->head(); ?>
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

    <?= $this->render('pager'); ?>

</div>

<?php $this->registerJsFile('/js/jquery.min.js'); ?>
<?php $this->registerJsFile('/js/bootstrap.min.js'); ?>

<?php $this->endBody(); ?>
</body>
<html>

<?php $this->endPage(); ?>
