<?php

use frontend\models\Categories;
use frontend\models\UserFilter;
use yii\helpers\Html;
use yii\web\View;
use frontend\models\Tasks;
use frontend\models\Users;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var Users[] $users
 * @var Tasks[] $tasks
 * @var UserFilter $filter
 * @var Categories[] $cat
 */

$this->title = 'Users Controller';
?>
<section class="user__search">
    <?php foreach ($users as $user): ?>
    <div class="content-view__feedback-card user__search-wrapper">
        <div class="feedback-card__top">
            <div class="user__search-icon">
                <a href="user.html"><img src="./img/man-glasses.jpg" width="65" height="65"></a>
                <span>17 заданий</span>
                <span>6 отзывов</span>
            </div>
            <div class="feedback-card__top--name user__search-card">
                <p class="link-name"><a href="user.html" class="link-regular"><?= $user->name;?></a></p>
                <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                <b>4.25</b>
                <p class="user__search-content">
                    <?= $user->info;?>
                </p>
            </div>
            <span class="new-task__time">Был на сайте 25 минут назад</span>
        </div>
        <div class="link-specialization user__search-link--bottom">
            <a href="browse.html" class="link-regular">Ремонт</a>
            <a href="browse.html" class="link-regular">Курьер</a>
            <a href="browse.html" class="link-regular">Оператор ПК</a>
        </div>
    </div>
    <?php endforeach;?>
</section>
<section class="search-task">
    <div class="search-task__wrapper">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'search-task__form'],
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
                <?= Html::activeCheckbox($filter, 'isFree', ['label' => false, 'class' => 'visually-hidden checkbox__input'])?>
                <span>
                    <?= Html::encode($filter->getAttributeLabel('isFree'))?>
                </span>
            </label>
            <label class="checkbox__legend">
                <?= Html::activeCheckbox($filter, 'isOnline', ['label' => false, 'class' => 'visually-hidden checkbox__input'])?>
                <span>
                    <?= Html::encode($filter->getAttributeLabel('isOnline'))?>
                </span>
            </label>
            <label class="checkbox__legend">
                <?= Html::activeCheckbox($filter, 'hasReview', ['label' => false, 'class' => 'visually-hidden checkbox__input'])?>
                <span>
                    <?= Html::encode($filter->getAttributeLabel('hasReview'))?>
                </span>
            </label>
            <label class="checkbox__legend">
                <?= Html::activeCheckbox($filter, 'hasFavorite', ['label' => false, 'class' => 'visually-hidden checkbox__input'])?>
                <span>
                    <?= Html::encode($filter->getAttributeLabel('hasFavorite'))?>
                </span>
            </label>
        </fieldset>

        <?= $form->field($filter, 'name', [
            'template'     => "{label}\n{input}",
            'options'      => ['tag' => false],
            'labelOptions' => ['class' => 'search-task__name']
        ])->textInput(['class' => 'input-middle input', 'id' => '9', 'type' => 'search', 'placeholder' => '']);?>

        <?= Html::submitButton('Искать', ['class' => 'button']) ?>
        <?php ActiveForm::end();?>
    </div>
</section>

