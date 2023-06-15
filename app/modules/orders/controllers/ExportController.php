<?php

namespace app\modules\orders\controllers;

use app\modules\orders\models\SearchOrder;
use Yii;
use yii\base\InvalidArgumentException;
use yii\db\mssql\PDO;
use yii\web\Controller;
use yii\web\RangeNotSatisfiableHttpException;
use yii\web\Response;

class ExportController extends Controller
{
    private string $csv;

    /**
     * @throws InvalidArgumentException
     * @throws RangeNotSatisfiableHttpException
     */
    public function actionIndex()
    {
        $date = date('d.m.Y');

        $this->setCSV(__DIR__ . '/../tmp/' . 'export_' . $date . '.csv');

        $params = \Yii::$app->request->queryParams;
        unset($params['page']);

        $stream = fopen('php://output', 'a');


        header('Content-Disposition: attachment;filename="export_' . $date . '.csv"');

        ob_start();
        fputcsv(
            $stream,
            [
                'ID',
                Yii::t('app', 'user.list.columns.user'),
                Yii::t('app', 'user.list.columns.link'),
                Yii::t('app', 'user.list.columns.quantity'),
                Yii::t('app', 'user.list.services.services'),
                Yii::t('app', 'user.list.columns.status'),
                Yii::t('app', 'user.list.columns.mode'),
                Yii::t('app', 'user.list.columns.created'),
                "\r\n"
            ]);

        ob_flush();
        flush();

        $searchModel = new SearchOrder();

        foreach ($searchModel->search($params, true)->batch() as $search) {
            foreach ($search as $value) {
                fputcsv(
                    $stream,
                    [
                        $value['id'],
                        $value['last_name'] . ' ' . $value['first_name'],
                        $value['link'],
                        $value['quantity'],
                        $value['service_id'] . ' ' . $value['service_name'],
                        $value['status'],
                        $value['mode'],
                        date("Y-m-d h:i:s", $value['created_at'])
                    ]);
                ob_flush();
                flush();
            }
        }

        ob_end_clean();
        exit();
    }


    private function setCSV($path)
    {
        $this->csv = $path;
    }

}
