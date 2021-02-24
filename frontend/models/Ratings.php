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
 * @property Users $user
 * @property Users $freelancer
 * @property Tasks $task
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
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
            [['freelancer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['freelancer_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::class, 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => Yii::t('app', 'id пользователя'),
            'freelancer_id' => Yii::t('app', 'id исполнителя'),
            'task_id' => Yii::t('app', 'id задания'),
            'review' => Yii::t('app', 'Текст отзыва'),
            'rating' => Yii::t('app', 'Рейтинг'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Freelancer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFreelancer()
    {
        return $this->hasOne(Users::class, ['id' => 'freelancer_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::class, ['id' => 'task_id']);
    }
}
