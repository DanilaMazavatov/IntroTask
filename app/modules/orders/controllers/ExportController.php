<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\SearchOrder;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `orders` module
 */
class ExportController extends Controller
{
    private string $csv;

    public function actionIndex() {

        ini_set('memory_limit', '32M');

        $this->setCSV(__DIR__ . '/../tmp/' . 'export_' . date('d.m.Y') . '.csv');

        $params = \Yii::$app->request->queryParams;
        unset($params['page']);

        $this->writeToCsv("ID;User;Link;Quantity;Services;Status;Mode;Created\r\n");

        $searchModel = new SearchOrder();

        foreach ($searchModel->search($params, true)->batch() as $search) {
            foreach ($search as $value) {
                $tmp_data =
                    ';' . $value['id'] .
                    ';' . $value['last_name'] . ' ' . $value['first_name'] .
                    ';' . $value['link'] .
                    ';' . $value['quantity'] .
                    ';' . $value['service_id'] . ' ' . $value['service_name'] .
                    ';' . $value['status'] .
                    ';' . $value['mode'] .
                    ';' . $value['created_at'] .
                    "\r\n";

                $this->writeToCsv($tmp_data);
            }
        }

        Yii::$app->response->sendFile($this->csv, 'orders_' . date('d.m.Y') . '.csv', ['inline' => false])->send();

    }

    private function writeToCsv($data)
    {
        $tmp = fopen($this->csv, 'a+');
        fwrite($tmp, $data);
        fclose($tmp);
    }

    private function setCSV($path)
    {
        $this->csv = $path;
    }
}
