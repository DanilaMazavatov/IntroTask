<?php

/** @var yii\web\View $this */
/** @var yii\web\View $statuses */

Yii::$app->language = (Yii::$app->language == 'ru') ? '' : Yii::$app->language;

use yii\helpers\Url;

?>
<?php

$data = '';
foreach ($statuses as $key => $status) {
    if ($status === Yii::$app->request->get('status')) {
        $data .= "<li class=\"active\">";
    } else {
        $data .= "<li>";
    }

    if ($key == 'All orders') {
        $data .= "<a href=\"" . Url::to(['/orders?page=1', 'language' => Yii::$app->language])
            . "\">All orders</a>";
    } else {
        $data .= "<a href=\"" . Url::to(["/orders?page=1&status=$status", 'language' => Yii::$app->language]). "\">$key</a>";
    }

    $data .= "</li>";
}

echo $data;
unset($data);
?>
