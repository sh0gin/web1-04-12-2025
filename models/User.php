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
 * @property string|null $authKey
 * @property string $name
 *
 * @property Role $role
 * @property UserOrder[] $userOrders
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public const REGISTER = 'register';

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
            [['authKey'], 'default', 'value' => null],
            [['role_id'], 'default', 'value' => 1],
            [['email', 'password', 'name'], 'required'],
            [['role_id'], 'integer'],
            [['email', 'password', 'authKey', 'name'], 'string', 'max' => 255],
            [['email'], 'unique', 'on' => self::REGISTER],
            ['email', 'email', 'on' => self::REGISTER],
            ['password', 'string', 'min' => 3],
            ['password', 'match', 'pattern' => "/(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[_#!%])[a-zA-z_#!%\d]/", 'message' => 'обязательное, минимум 3 символа, с содержанием минимум одного символа верхнего и нижнего регистра, одной цифры и один из спецсимволов «_», «#», «!», «%»', 'on' => self::REGISTER],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Почта',
            'password' => 'Пароль',
            'role_id' => 'Роль',
            'name' => 'Имя',
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

    public function getRoleId()
    {
        return $this->role;
    }

    public function getIsAdmin()
    {
        return $this->role_id == 2;
    }

    public static function findByUsername($email)
    {
        return self::findOne(['email' => $email]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
