<?php

/* @var $this yii\web\View */

use frontend\models\Tasks;
use frontend\models\Users;

$this->title = 'Test Controller';

//$user = new Users();
$users = Users::find()->all();
$tasks = Tasks::find()->all();
?>
Пользователи:
<ul>
    <?php foreach ($users as $user):?>
        <li>
            <?=$user->name;?>
            <?=$user->role;?>
            <?=$user->password;?>
        </li>
    <?php endforeach;?>
</ul>

Задания:
<ul>
    <?php foreach ($tasks as $task):?>
        <li>
            <?=$task->userCreate->name;?>
            <?=$task->category->name;?>
            <?=$task->title;?>
        </li>
    <?php endforeach;?>
</ul>
