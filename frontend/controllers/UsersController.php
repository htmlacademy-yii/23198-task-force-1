<?php


namespace frontend\controllers;

use frontend\models\Categories;
use frontend\models\UserFilter;
use frontend\models\Users;

use Taskforce\base\Task;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class UsersController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $users = Users::find()
            ->where(['role' => Task::ROLE_WORKER]);

        $filter = new UserFilter();

        if (Yii::$app->request->getIsPost()) {
            $filter->load(Yii::$app->request->post());
            $filter->apply($users);
        }

        $categories = ArrayHelper::map(
            Categories::find()->all(),
            'id',
            'name'
        );

        return $this->render('index',['users' => $users->orderBy(['id' => SORT_DESC])->all(), 'filter' => $filter, 'cat' => $categories]);
    }
}
