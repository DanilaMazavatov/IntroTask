<?php

/** @var yii\web\View $this */
/** @var yii\web\View $statuses */

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
        $data .= "<a href=\"/orders?page=1"
            . "\">All orders</a>";
    } else {
        $data .= "<a href=\"/orders?page=1"
            . "&status=" . $status . "\">$key</a>";
    }

    $data .= "</li>";
}

echo $data;
unset($data);
?>
