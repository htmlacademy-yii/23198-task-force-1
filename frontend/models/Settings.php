<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property int $user_id id пользователя
 * @property int $contact_hide Видимость контактов
 * @property int $profile_hide Видимость профиля
 * @property int $new_message Уведомление о новых сообщениях
 * @property int $action_task Уведомление о действиях по заданию
 * @property int $new_review Уведомление о новом отзыве
 *
 * @property-read  Users $user
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'contact_hide', 'profile_hide', 'new_message', 'action_task', 'new_review'], 'integer'],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'contact_hide' => Yii::t('app', 'Видимость контактов'),
            'profile_hide' => Yii::t('app', 'Видимость профиля'),
            'new_message' => Yii::t('app', 'Уведомление о новых сообщениях'),
            'action_task' => Yii::t('app', 'Уведомление о действиях по заданию'),
            'new_review' => Yii::t('app', 'Уведомление о новом отзыве'),
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
}
