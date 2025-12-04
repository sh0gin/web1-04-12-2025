<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property int $id
 * @property int $courses_id
 * @property string $name
 * @property string $description
 * @property string $video_link
 * @property int $hours
 *
 * @property Courses $courses
 */
class Video extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courses_id', 'name', 'description', 'video_link', 'hours'], 'required'],
            [['courses_id', 'hours'], 'integer'],
            [['name', 'description', 'video_link'], 'string', 'max' => 255],
            [['courses_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['courses_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'courses_id' => 'Courses ID',
            'name' => 'Name',
            'description' => 'Description',
            'video_link' => 'Video Link',
            'hours' => 'Hours',
        ];
    }

    /**
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasOne(Courses::class, ['id' => 'courses_id']);
    }

}
