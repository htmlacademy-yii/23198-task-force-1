<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name ФИО пользователя
 * @property string $email email пользователя
 * @property int $city_id id города пользователя
 * @property string|null $birthday Дата рождения
 * @property string|null $info Информация о пользователе
 * @property string $role Роль пользователя
 * @property string $password Пароль пользователя
 * @property string|null $phone Телефон
 * @property string|null $skype Скайп
 * @property string|null $telegram Телеграм
 *
 * @property Callbacks[] $callbacks
 * @property Favorite[] $favorites
 * @property Messages[] $messagesFromUser
 * @property Messages[] $messagesToUser
 * @property Photos[] $photos
 * @property Ratings[] $ratingsUser
 * @property Ratings[] $ratingsFreelancer
 * @property Settings $settings
 * @property Tasks[] $tasksUser
 * @property Tasks[] $tasksFreelancer
 * @property Cities $city
 * @property UsersSpecialization[] $usersSpecializations
 * @property Categories[] $categories
 */
class Users extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'city_id', 'password'], 'required'],
            [['city_id'], 'integer'],
            [['birthday'], 'safe'],
            [['role'], 'string'],
            [['name', 'email'], 'string', 'max' => 100],
            [['info'], 'string', 'max' => 1000],
            [['password'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 11],
            [['skype', 'telegram'], 'string', 'max' => 50],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'ФИО пользователя'),
            'email' => Yii::t('app', 'Электронная почта пользователя'),
            'city_id' => Yii::t('app', 'id города пользователя'),
            'birthday' => Yii::t('app', 'Дата рождения'),
            'info' => Yii::t('app', 'Информация о пользователе'),
            'role' => Yii::t('app', 'Роль пользователя'),
            'password' => Yii::t('app', 'Пароль пользователя'),
            'phone' => Yii::t('app', 'Телефон'),
            'skype' => Yii::t('app', 'Скайп'),
            'telegram' => Yii::t('app', 'Телеграм'),
        ];
    }

    /**
     * Gets query for [[Callbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCallbacks()
    {
        return $this->hasMany(Callbacks::class, ['freelancer_id' => 'id']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[MessagesFromUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessagesFromUser()
    {
        return $this->hasMany(Messages::class, ['from_user_id' => 'id']);
    }

    /**
     * Gets query for [[MessagesToUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessagesToUser()
    {
        return $this->hasMany(Messages::class, ['to_user_id' => 'id']);
    }

    /**
     * Gets query for [[Photos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[RatingsUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Ratings::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[RatingsFreelancer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatingsFreelancer()
    {
        return $this->hasMany(Ratings::class, ['freelancer_id' => 'id']);
    }

    /**
     * Gets query for [[Settings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasOne(Settings::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TasksUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasksUser()
    {
        return $this->hasMany(Tasks::class, ['user_create' => 'id']);
    }

    /**
     * Gets query for [[TasksFreelancer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasksFreelancer()
    {
        return $this->hasMany(Tasks::class, ['freelancer' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[UsersSpecializations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsersSpecializations()
    {
        return $this->hasMany(UsersSpecialization::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::class, ['id' => 'category_id'])->viaTable('users_specialization', ['user_id' => 'id']);
    }
}
