<?php


namespace frontend\models;

use yii\base\Model;
use yii\db\ActiveQuery;
use yii\db\Expression;


class TaskFilter extends Model
{

    public $categories;
    public $notWorker;
    public $remoteTask;
    public $period;
    public $title;


    public function attributeLabels()
    {
        return [
            'categories' => 'Категории',
            'notWorker' => 'Без исполнителя',
            'remoteTask' => 'Удаленная работа',
            'title' => 'Поиск по названию',
            'period' => 'Период'
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'notWorker', 'remoteTask', 'period', 'title'], 'safe'],
            [['notWorker', 'remoteTask'], 'boolean'],
            [['title'], 'filter', 'filter' => 'htmlspecialchars'],
            [['title'], 'string']
        ];
    }

    const PERIOD_ALL = 'all';
    const PERIOD_DAY = 'day';
    const PERIOD_WEEK = 'week';
    const PERIOD_MONTH = 'month';

    const PERIODS = [
        self::PERIOD_ALL => 0,
        self::PERIOD_DAY => 1,
        self::PERIOD_WEEK => 7,
        self::PERIOD_MONTH => 30
    ];

    const PERIODS_TITLES = [
        self::PERIOD_ALL => 'За все время',
        self::PERIOD_DAY => 'За день',
        self::PERIOD_WEEK => 'За неделю',
        self::PERIOD_MONTH => 'За месяц'
    ];

    public function apply(ActiveQuery $tasks): void
    {
        if ($this->categories) {
            $tasks->andWhere(['category_id' => $this->categories]);
        }

        if ($this->notWorker) {
            $tasks->andWhere(['freelancer' => NULL]);
        }

        if ($this->remoteTask) {
            $tasks->andWhere(['city_id' => NULL]);
        }

        if ($this->period) {
            if ($this->period === 'all') {
                $tasks->andFilterWhere(['!=', 'create_at', 'NULL']);
            }else {
                $expression = new Expression(sprintf( ('CURRENT_TIMESTAMP() - INTERVAL %d DAY'), self::PERIODS[$this->period]));
                $tasks->andFilterWhere(['>', 'create_at',  $expression]);
            }
        }

        if ($this->title) {
            $tasks->andFilterWhere(['like','title', $this->title]);
        }
    }
}
