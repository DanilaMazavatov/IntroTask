<?php

/** @var yii\web\View $this */
/** @var yii\web\View $statuses */

$language = (Yii::$app->language == 'ru') ? '' : Yii::$app->language;

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
        $data .= "<a href=\"" . Url::to(['/orders?page=1', 'language' => $language])
            . "\">All orders</a>";
    } else {
        $data .= "<a href=\"" . Url::to(["/orders?page=1&status=$status", 'language' => $language]). "\">$key</a>";
    }

    $data .= "</li>";
}

echo $data;
unset($data);
?>
