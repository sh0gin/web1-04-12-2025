<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_status".
 *
 * @property int $id
 * @property string $title
 *
 * @property UserOrder[] $userOrders
 */
class PaymentStatus extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[UserOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserOrders()
    {
        return $this->hasMany(UserOrder::class, ['payment_status_id' => 'id']);
    }

    public static function getId($title): int {
        return self::findOne(['title' => $title])->id;
    }

    public static function getTitle($id): string {
        return self::findOne($id)->title;
    }
}
