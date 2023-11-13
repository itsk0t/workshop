<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "applications".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phone_number
 * @property string $body
 * @property int $services_id
 * @property int $user_id
 * @property int $status
 *
 * @property Services $services
 * @property User $user
 */
class Applications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'applications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'phone_number', 'body', 'services_id'], 'required'],
            [['body'], 'string'],
            [['services_id', 'status'], 'integer'],
            ['user_id', 'default', 'value'=>Yii::$app->user->getId()],
            [['name', 'surname', 'phone_number'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 128],
            [['services_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::class, 'targetAttribute' => ['services_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'email' => 'Email адрес',
            'phone_number' => 'Номер телефона',
            'body' => 'Текст заявки',
            'services_id' => 'Услуга',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasOne(Services::class, ['id' => 'services_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function getStatus()
    {
        switch ($this->status) {
            case 0: return 'Отменёна';
            case 1: return 'Рассматривается';
            case 2: return 'Одобрена';
        }
    }

    public function getColor()
    {
        switch ($this->status) {
            case 0: return 'p-3 mb-2 bg-danger text-white';
            case 1: return 'p-3 mb-2 bg-warning text-dark';
            case 2: return 'p-3 mb-2 bg-success text-white';
        }
    }
}
