<?php


namespace frontend\controllers;
use Yii;

use yii\web\Controller;

class TestController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
