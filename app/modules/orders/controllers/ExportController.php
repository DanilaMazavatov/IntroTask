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

        $this->setCSV(__DIR__ . '/../tmp/' . 'export_' . date('d.m.Y') . '.csv');

        $params = \Yii::$app->request->queryParams;
        unset($params['page']);

        $this->writeToCsv(';ID;' .
            Yii::t('app', 'user.list.columns.user') . ';' .
            Yii::t('app', 'user.list.columns.link') . ';' .
            Yii::t('app', 'user.list.columns.quantity') . ';' .
            Yii::t('app', 'user.list.services.services') . ';' .
            Yii::t('app', 'user.list.columns.status') . ';' .
            Yii::t('app', 'user.list.columns.mode') . ';' .
            Yii::t('app', 'user.list.columns.created') . ';'
            . "\r\n");

        \Yii::$app->db->masterPdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

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

        \Yii::$app->db->masterPdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;

        $handle = fopen($this->csv, 'rb');

        header('Content-type: application/octet-stream');
        header('Content-Disposition: attachment; filename="orders_' . date('d.m.Y') . '.csv"');

        while (!feof($handle)) {
            echo fread($handle, 8192);
            ob_flush();
            flush();
        }

        fclose($handle);

        exit(unlink($this->csv));

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
