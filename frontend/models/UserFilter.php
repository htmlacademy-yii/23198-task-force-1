<?php


namespace frontend\models;


use Taskforce\base\Task;
use yii\base\Model;
use yii\db\ActiveQuery;
use yii\db\Expression;

class UserFilter extends Model
{
    public $categories;
    public $isFree;
    public $isOnline;
    public $hasReview;
    public $hasFavorite;
    public $name;

    public function attributeLabels()
    {
        return [
          'categories' => 'Категории',
          'isFree' => 'Сейчас свободнен',
          'isOnline' => 'Сейчас онлайн',
          'hasReview' => 'Есть отзывы',
          'hasFavorite' => 'В избранном',
          'name' => 'Поиск по имени'
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'isFree', 'isOnline', 'hasReview', 'hasFavorite', 'name'], 'safe'],
            [['isFree', 'isOnline', 'hasReview', 'hasFavorite'], 'boolean'],
            [['name'], 'filter', 'filter' => 'htmlspecailchars'],
            [['name'], 'string']
        ];
    }

    public function apply(ActiveQuery $users) : void
    {
        if ($this->categories) {
            $users->joinWith('usersSpecializations')->andWhere(['users_specialization.category_id' => $this->categories]);
        }

        if($this->isFree) {
            $users->joinWith('tasksFreelancer')->andWhere(['tasks.status' => Task::STATUS_DONE]);
        }

        if ($this->isOnline) {
            $expression = new Expression(sprintf(('CURRENT_TIMESTAMP() - INTERVAL %d MINUTE'), 30));
            $users->andFilterWhere(['<=', 'last_visit',  $expression]);
        }

        if ($this->hasReview) {
            $users->joinWith('ratings')->andWhere(['ratings.review' => 'NOT NULL']);
        }

        if ($this->hasFavorite) {
            $users->joinWith('favorites')->andWhere(['favorite.user_id' => 'user.id']);
        }

        if ($this->name) {
            $users->andFilterWhere(['like', 'name', $this->name]);
        }
    }


}
