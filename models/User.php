<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int $role_id
 * @property string $authKey
 *
 * @property Role $role
 * @property UserOrder[] $userOrders
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['role_id'], 'integer'],
            [['email', 'password', 'authKey'], 'string', 'max' => 255],
            [['email'], 'unique', 'on' => 'register'],
            [['email'], 'email'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
            ['password', 'string', 'min' => 3],
            // ['password', 'match', 'pattern' => '/(?=.*[a-z])[a-zA-Z_#!%\d]+/', "message" => "обязательное, минимум 3 символа, с содержанием минимум одного символа верхнего и нижнего регистра, одной цифры и один из спецсимволов «_», «#», «!», «%»"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'role_id' => 'Role ID',
            'authKey' => 'Auth Key',
        ];
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[UserOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserOrders()
    {
        return $this->hasMany(UserOrder::class, ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['authKey' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function getRoleId() {
        return $this->role;
    }

    public function getIsAdmin() {
        return $this->role == 1;
    }

    public static function findByUsername($email) {
        return self::findOne(['email' => $email]);
    }

    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
