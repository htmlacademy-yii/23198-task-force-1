<?php

/* @var $this yii\web\View */

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
