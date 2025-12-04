<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $payment_status_id
 *
 * @property Courses $course
 * @property PaymentStatus $paymentStatus
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
            [['user_id', 'course_id', 'payment_status_id'], 'required'],
            [['user_id', 'course_id', 'payment_status_id'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_id' => 'id']],
            [['payment_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentStatus::class, 'targetAttribute' => ['payment_status_id' => 'id']],
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
            'user_id' => 'User ID',
            'course_id' => 'Course ID',
            'payment_status_id' => 'Payment Status ID',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
