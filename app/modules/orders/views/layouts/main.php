<?php

/** @var yii\web\View $this */
/** @var yii\web\View $content */
/** @var yii\web\View $pages */

$language_change = Yii::$app->language == 'en' ? "ru" : "en";

?>

<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title ?></title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">

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
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<?php $this->endBody(); ?>
</body>
<html>

<?php $this->endPage(); ?>
