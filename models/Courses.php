<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

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
    const REGISTER = 'register';
    const UPDATE = 'update';
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
            [['name', 'description', 'hours', 'start_date', 'end_date', 'price'], 'required'],
            [['hours'], 'integer'],
            ['name', 'string', 'max' => 30],
            ['description', 'string', 'max' => 100],
            ['hours', 'compare', 'compareValue' => 10, 'operator' => "<="],
            ['price', 'compare', 'compareValue' => 100, 'operator' => ">="],
            [['start_date', 'end_date'], 'safe'],
            [['price'], 'number'],
            ['image_full', 'file', 'extensions' => ['jpeg', 'jpg'], 'skipOnEmpty' => false, 'maxSize' => 1024 * 2000, 'on' => self::REGISTER],
            [['end_date', 'start_date'], 'validateDate'],
            ['image_full', 'file', 'extensions' => ['jpeg', 'jpg'], 'skipOnEmpty' => true, 'maxSize' => 1024 * 2000, 'on' => self::UPDATE],
            ['img', 'string'],
            [
                ['start_date', 'end_date'],
                'date',
                'format' => 'php:Y-m-d',
            ],
            [
                ['start_date', 'end_date'],
                'compare',
                'compareValue' => date('Y-m-d'),
                'operator' => '>=',
                'message' => 'Дата должна быть больше текущей'
            ],
            [
                'end_date',
                'compare',
                'compareAttribute' => 'start_date',
                'operator' => '>='
            ]
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

    public function validateDate($attribute, $params)
    {
        $dateString = $this->$attribute;
        $date = \DateTime::createFromFormat('Y-m-d', $dateString);
        
        // почему здесь такой формат
        if (!$date || Yii::$app->formatter->asDate($date, 'php:Y-m-d') != $dateString) {
            $this->addError($attribute, 'Дата должна быть валидной ');
        }
        if ($date < new \DateTime()) {
            $this->addError($attribute, 'Дата уже прошла ');
        }
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

    public static function getTitle($id)
    {
        return self::findOne($id)->name;
    }

    public static function getTitleAll()
    {
        return self::find()->select('name')->indexBy('id')->column();
    }

    public function upload()
    {
        // с документации
        $this->image_full->saveAs('img/' . $this->image_full->name); // мы сначало сохраняем, а потом меняем, чтобы у нас файл был?
        $img = file_get_contents('img/' . $this->image_full->name);
        $im = imagecreatefromstring($img);
        $width = imagesx($im);

        $height = imagesy($im);
        $maxWidth = 300;
        $maxHeight = 300;
        $ratioHeight = $maxHeight / $height;
        $ratioWidth = $maxWidth / $width;
        $ratio = min($ratioHeight, $ratioWidth);

        $newWidth = (int) ($ratio * $width);
        $newHeight = (int) ($ratio * $height);
        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($thumb, $im, 0, 0, 0, 0,  $newWidth, $newHeight, $width, $height);
        $path = "mpic" . Yii::$app->security->generateRandomString(5) . $this->image_full->extension;
        imagejpeg($thumb, 'img/' . $path);
        return $path;
    }
}
