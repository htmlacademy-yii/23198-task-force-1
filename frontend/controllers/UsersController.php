<?php


namespace frontend\controllers;

use frontend\models\Users;

use yii\web\Controller;

class UsersController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $users = Users::find()->where(['role' => 'worker'])->orderBy(['id' => SORT_DESC])->all();

        return $this->render('index',['users' => $users]);
    }
}
