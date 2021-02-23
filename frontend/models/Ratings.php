<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ratings".
 *
 * @property int $id
 * @property int $user_id id пользователя
 * @property int $freelancer_id id исполнителя
 * @property int $task_id id задания
 * @property string|null $review Текст отзыва
 * @property float|null $rating Рейтинг
 *
 * @property User $user
 * @property User $freelancer
 * @property Task $task
 */
class Ratings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'freelancer_id', 'task_id'], 'required'],
            [['user_id', 'freelancer_id', 'task_id'], 'integer'],
            [['review'], 'string'],
            [['rating'], 'number'],
            [['user_id', 'freelancer_id', 'task_id'], 'unique', 'targetAttribute' => ['user_id', 'freelancer_id', 'task_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['freelancer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['freelancer_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'freelancer_id' => 'Freelancer ID',
            'task_id' => 'Task ID',
            'review' => 'Review',
            'rating' => 'Rating',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Freelancer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFreelancer()
    {
        return $this->hasOne(User::className(), ['id' => 'freelancer_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
