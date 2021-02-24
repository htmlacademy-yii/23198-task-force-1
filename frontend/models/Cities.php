<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name Город
 * @property string $longitude Долгота
 * @property string $latitude Широта
 *
 * @property Users[] $users
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'longitude', 'latitude'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['longitude', 'latitude'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::class, ['city_id' => 'id']);
    }
}
