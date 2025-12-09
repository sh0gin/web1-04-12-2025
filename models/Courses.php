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
    public $image_full;

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
            ['name', 'string', 'max' => 30],
            ['description', 'string', 'max' => 100],
            ['hours', 'compare', 'compareValue' => 10, 'operator' => "<="],
            ['price', 'compare', 'compareValue' => 100, 'operator' => ">="],
            [['start_date', 'end_date'], 'safe'],
            [['price'], 'number'],
            ['image_full', 'file', 'extensions' => ['jpeg', 'jpg']],
            ['img', 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'hours' => 'Длительность',
            'img' => 'Обложка',
            'start_date' => 'Начало курса',
            'end_date' => 'Конец курса',
            'price' => 'Стоимость',
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
