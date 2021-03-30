<?php

use frontend\models\Cities;
use yii\web\View;
use frontend\models\Categories;
use frontend\models\TaskFilter;
use frontend\models\Tasks;
use yii\widgets\ActiveField;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var View $this
 * @var Tasks[] $tasks
 * @var TaskFilter $filter
 * @var Categories[] $cat
 */

$this->title = 'Tasks Controller';
?>
<section class="new-task">
    <div class="new-task__wrapper">
        <h1>Новые задания</h1>
        <?php foreach ($tasks as $task): ?>
        <div class="new-task__card">
            <div class="new-task__title">
                <a href="view.html" class="link-regular"><h2><?= $task->title; ?></h2></a>
                <a class="new-task__type link-regular" href="#"><p><?= $task->category->name; ?></p></a>
            </div>
            <div class="new-task__icon new-task__icon--translation"></div>
            <p class="new-task_description">
                <?= $task->description; ?>
            </p>
            <b class="new-task__price new-task__price--translation"><?= $task->priceFormat; ?></b>
            <p class="new-task__place">Санкт-Петербург, Центральный район</p>
            <span class="new-task__time"><?= $task->createdAtFormat; ?></span>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="new-task__pagination">
        <ul class="new-task__pagination-list">
            <li class="pagination__item"><a href="#"></a></li>
            <li class="pagination__item pagination__item--current">
                <a>1</a></li>
            <li class="pagination__item"><a href="#">2</a></li>
            <li class="pagination__item"><a href="#">3</a></li>
            <li class="pagination__item"><a href="#"></a></li>
        </ul>
    </div>
</section>
<section class="search-task">
    <div class="search-task__wrapper">
        <?php $form = ActiveForm::begin([
            'id' => 'tasks-form',
            'options' => ['class' => 'search-task__form'],
            'fieldConfig' => [
                'template' => "{input}\n{error}",
                'options' => ['class' => 'checkbox__input', 'tag' => false]
            ]
        ]);?>
        <fieldset class="search-task__categories">
            <legend>Категории</legend>
            <?= Html::activeCheckBoxList(
                $filter,
                'categories',
                $cat,
                [
                    'class' => '_visually-hidden checkbox__input',
                    'item'  => function (
                        $index,
                        $label,
                        $name,
                        $checked,
                        $value
                    ) {
                        $isChecked = $checked ? 'checked' : '';
                        return <<<HTML
                        <label class="checkbox__legend" for="{$index}">
                        <input class="visually-hidden checkbox__input"
                            id="{$index}"
                            type="checkbox"
                            name="{$name}"
                            value="{$value}"
                            {$isChecked}>
                       <span>{$label}</span>
                       </label>
HTML;
                        }
                ]
            );?>
        </fieldset>
        <fieldset class="search-task__categories">
            <legend>Дополнительно</legend>
            <label class="checkbox__legend">
                <?= Html::activeCheckbox($filter, 'remoteTask', ['label' => false, 'class' => 'visually-hidden checkbox__input'])?>
                <span>
                    <?= Html::encode($filter->getAttributeLabel('remoteTask'))?>
                </span>
            </label>
            <label class="checkbox__legend">
                <?= Html::activeCheckbox($filter, 'notWorker', ['label' => false, 'class' => 'visually-hidden checkbox__input'])?>
                <span>
                    <?= Html::encode($filter->getAttributeLabel('notWorker'))?>
                </span>
            </label>
        </fieldset>
        <?= $form->field(
            $filter,
            'period',
            [
                'template'     => "{label}\n{input}",
                'options'      => ['tag' => false],
                'labelOptions' => ['class' => 'search-task__name']
            ])->dropDownList(
            TaskFilter::PERIODS_TITLES,
            [
                'class' => 'multiple-select input',
                'options' => [TaskFilter::PERIOD_ALL => ['Selected' => true]]
            ]
        );
        ?>
        <div class="field-container">
            <?= $form->field($filter, 'title', [
                'template'     => "{label}\n{input}",
                'options'      => ['tag' => false],
                'labelOptions' => ['class' => 'search-task__name']
            ])->textInput(['class' => 'input-middle input', 'id' => '9', 'type' => 'search', 'placeholder' => '']);?>
        </div>
        <?= Html::submitButton('Искать', ['class' => 'button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</section>
