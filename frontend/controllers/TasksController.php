<?php


namespace frontend\controllers;

use frontend\models\Categories;
use frontend\models\TaskFilter;
use frontend\models\Tasks;
use Taskforce\base\Task;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class TasksController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $tasks = Tasks::find()
                        ->where(['status' => Task::STATUS_NEW]);

        $filter = new TaskFilter();

        $categories = ArrayHelper::map(
            Categories::find()->all(),
            'id',
            'name'
        );

        if (Yii::$app->request->getIsPost()) {
            $filter->load(Yii::$app->request->post());
            $filter->apply($tasks);
        }
        return $this->render('index',
            [
             'tasks' => $tasks
                        ->orderBy(['id' => SORT_DESC])
                        ->all(),
             'filter' => $filter,
             'cat' => $categories
            ]);
    }

}

