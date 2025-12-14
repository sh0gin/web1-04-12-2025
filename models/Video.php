<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

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
            [['courses_id', 'name', 'description', 'hours'], 'required'],
            [['courses_id', 'hours'], 'integer'],
            [['name', 'description', 'video_link'], 'string', 'max' => 255],
            ['name', 'string', 'max' => 50],
            ['hours', 'compare', 'operator' => "<=", 'compareValue' => 4],
            [['courses_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['courses_id' => 'id']],
            ['hours', 'validateHours'],
            ['video_link', 'match', 'pattern' => '#^https://super-tube.cc/video/v[0-9]{5}$#', 'message' => 'Сслыка должна быть в формате https://super-tube.cc/video/v99999'],
        ];
    }

    public function validateHours($attribute, $params)
    {
        $hours = $this->$attribute;
        $course  = $this->courses;

        $totalLength =  $course->getVideos()->sum('hours');
        if (!$this->isNewRecord) {
            $totalLength -= $this->oldAttributes['length'];
        }

        if ($totalLength + $hours > $course->hours) {
            $this->addError('hours', 'продолжительность курса не может быть больше указнной в курсе');
        }
        $totalCount = $course->getVideos()->count();
        if ($this->isNewRecord) {
            if ($totalCount + 1 > 5) {
                $this->addError('hours', 'количество уроков не больше 5 ');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'courses_id' => 'Курс',
            'name' => 'Название урока',
            'description' => 'Описание',
            'video_link' => 'Ссылка на урок',
            'hours' => 'Продолжительность',
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
