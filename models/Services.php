<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $price
 * @property string $deadline
 * @property string $image
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body', 'price', 'deadline', 'image'], 'required'],
            [['body'], 'string'],
            [['price'], 'integer'],
            [['title'], 'string', 'max' => 64],
            [['deadline'], 'string', 'max' => 32],
            [['image'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'price' => 'Price',
            'deadline' => 'Deadline',
            'image' => 'Image',
        ];
    }
}
