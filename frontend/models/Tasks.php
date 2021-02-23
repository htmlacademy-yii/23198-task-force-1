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
 * @property Callback[] $callbacks
 * @property Favorite[] $favorites
 * @property File[] $files
 * @property Message[] $messages
 * @property Rating[] $ratings
 * @property User $userCreate
 * @property User $freelancer0
 * @property Category $category
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
            [['user_create'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_create' => 'id']],
            [['freelancer'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['freelancer' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_create' => 'User Create',
            'freelancer' => 'Freelancer',
            'category_id' => 'Category ID',
            'status' => 'Status',
            'title' => 'Title',
            'description' => 'Description',
            'create_at' => 'Create At',
            'price' => 'Price',
            'deadline' => 'Deadline',
            'city_id' => 'City ID',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
        ];
    }

    /**
     * Gets query for [[Callbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCallbacks()
    {
        return $this->hasMany(Callbacks::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorites::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Ratings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Ratings::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[UserCreate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreate()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_create']);
    }

    /**
     * Gets query for [[Freelancer0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFreelancer0()
    {
        return $this->hasOne(Users::className(), ['id' => 'freelancer']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
