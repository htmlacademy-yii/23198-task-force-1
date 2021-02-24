<?php

use yii\web\View;
use frontend\models\Tasks;
use frontend\models\Users;

/**
 * @var View $this
 * @var Users[] $users
 * @var Tasks[] $tasks
 */

$this->title = 'Test Controller';
?>
Пользователи:
<?php if ($users): ?>
<ul>
    <?php foreach ($users as $user):?>
        <li>
            <?=$user->name;?>
            <?=$user->role;?>
            <?=$user->password;?>
        </li>
    <?php endforeach;?>
</ul>
<?php endif; ?>
<?php if ($tasks): ?>
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
<?php endif; ?>
