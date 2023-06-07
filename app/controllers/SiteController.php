<?php


namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use app\modules\orders\models\OrderModel;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use function Psy\debug;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        $orders = new OrderModel();
//        $data = $orders->find()->limit('100')->all();
//        echo $this->render('index', array(
//            'data' => $data
//        ));
    }

    public function actionSorting()
    {
        print_r('actionSorting');
    }

}