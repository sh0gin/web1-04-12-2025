<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $hours
 * @property string $img
 * @property string $start_date
 * @property string $end_date
 * @property float $price
 *
 * @property UserOrder[] $userOrders
 * @property Video[] $videos
 */
class Courses extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'hours', 'img', 'start_date', 'end_date', 'price'], 'required'],
            [['hours'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['price'], 'number'],
            [['name', 'description', 'img'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'hours' => 'Hours',
            'img' => 'Img',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[UserOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserOrders()
    {
        return $this->hasMany(UserOrder::class, ['course_id' => 'id']);
    }

    /**
     * Gets query for [[Videos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Video::class, ['courses_id' => 'id']);
    }

}
