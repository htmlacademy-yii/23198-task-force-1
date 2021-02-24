<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $from_user_id id отправителя
 * @property int $to_user_id id получателя
 * @property int $task_id id задания
 * @property string $created_at Дата создания
 * @property string $message Текст сообщения
 *
 * @property-read  Users $fromUser
 * @property-read  Users $toUser
 * @property-read  Tasks $task
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_user_id', 'to_user_id', 'task_id', 'message'], 'required'],
            [['from_user_id', 'to_user_id', 'task_id'], 'integer'],
            [['created_at'], 'safe'],
            [['message'], 'string', 'max' => 1000],
            [['from_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['from_user_id' => 'id']],
            [['to_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['to_user_id' => 'id']],
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
            'from_user_id' => Yii::t('app', 'id отправителя'),
            'to_user_id' => Yii::t('app', 'id получателя'),
            'task_id' => Yii::t('app', 'id задания'),
            'created_at' => Yii::t('app', 'Дата создания'),
            'message' => Yii::t('app', 'Текст сообщения'),
        ];
    }

    /**
     * Gets query for [[FromUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(Users::class, ['id' => 'from_user_id']);
    }

    /**
     * Gets query for [[ToUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToUser()
    {
        return $this->hasOne(Users::class, ['id' => 'to_user_id']);
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
