<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property int $user_create id пользователя
 * @property int|null $freelancer id исполнителя
 * @property int $category_id id категории
 * @property string|null $status статус задачи
 * @property string $title Заголовок задачи
 * @property string $description Описание задачи
 * @property string $create_at Время создания объявления
 * @property int $price Стоимость работы
 * @property string $deadline Дата завершения задачи
 * @property int|null $city_id id города
 * @property string|null $longitude Долгота
 * @property string|null $latitude Широта
 *
 * @property-read  Callbacks[] $callbacks
 * @property-read  Favorite[] $favorites
 * @property-read  Files[] $files
 * @property-read  Messages[] $messages
 * @property-read  Ratings[] $ratings
 * @property-read  Users $userCreate
 * @property-read  Users $freelancerTask
 * @property-read  Categories $category
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_create', 'category_id', 'title', 'description', 'price', 'deadline'], 'required'],
            [['user_create', 'freelancer', 'category_id', 'price', 'city_id'], 'integer'],
            [['status'], 'string'],
            [['create_at', 'deadline'], 'safe'],
            [['title', 'longitude', 'latitude'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1000],
            [['user_create'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_create' => 'id']],
            [['freelancer'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['freelancer' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_create' => Yii::t('app', 'id пользователя'),
            'freelancer' => Yii::t('app', 'id исполнителя'),
            'category_id' => Yii::t('app', 'id категории'),
            'status' => Yii::t('app', 'Статус задачи'),
            'title' => Yii::t('app', 'Заголовок задачи'),
            'description' => Yii::t('app', 'Описание задачи'),
            'create_at' => Yii::t('app', 'Время создания объявления'),
            'price' => Yii::t('app', 'Стоимость работы'),
            'deadline' => Yii::t('app', 'Дата завершения задачи задачи'),
            'city_id' => Yii::t('app', 'id города'),
            'longitude' => Yii::t('app', 'Долгота'),
            'latitude' => Yii::t('app', 'Широта'),
        ];
    }

    /**
     * Gets query for [[Callbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCallbacks()
    {
        return $this->hasMany(Callbacks::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Ratings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Ratings::class, ['task_id' => 'id']);
    }

    /**
     * Gets query for [[UserCreate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreate()
    {
        return $this->hasOne(Users::class, ['id' => 'user_create']);
    }

    /**
     * Gets query for [[Freelancer0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFreelancerTask()
    {
        return $this->hasOne(Users::class, ['id' => 'freelancer']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }
}
