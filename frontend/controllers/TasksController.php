<?php


namespace frontend\controllers;

use frontend\models\Tasks;
use frontend\models\Users;

use yii\web\Controller;

class TasksController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $users = Users::find()->all();
        $tasks = Tasks::find()->all();

        return $this->render('index',['users' => $users, 'tasks' => $tasks]);
    }
}
