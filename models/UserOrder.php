<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $status_id
 * @property int $payment_status_id
 * @property string $created_at
 *
 * @property Courses $course
 * @property PaymentStatus $paymentStatus
 * @property Status $status
 * @property User $user
 */
class UserOrder extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'course_id', 'status_id', 'payment_status_id'], 'required'],
            [['user_id', 'course_id', 'status_id', 'payment_status_id'], 'integer'],
            [['created_at'], 'safe'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_id' => 'id']],
            [['payment_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentStatus::class, 'targetAttribute' => ['payment_status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'course_id' => 'Course ID',
            'status_id' => 'Status ID',
            'payment_status_id' => 'Payment Status ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::class, ['id' => 'course_id']);
    }

    /**
     * Gets query for [[PaymentStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentStatus()
    {
        return $this->hasOne(PaymentStatus::class, ['id' => 'payment_status_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
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

}
