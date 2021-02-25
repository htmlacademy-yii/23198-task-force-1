<?php


namespace frontend\controllers;

use frontend\models\Tasks;

use yii\web\Controller;

class TasksController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $tasks = Tasks::find()->where(['status' => 'new'])->orderBy(['id' => SORT_DESC])->all();

        return $this->render('index',['tasks' => $tasks]);
    }
}
