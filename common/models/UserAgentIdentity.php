<?php
namespace common\models;

use yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class UserAgentIdentity extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['uid' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     */
    public static function findByPasswordResetToken($token)
    {
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if (md5(md5($password) . $this->password_salt) != $this->password) {
            //为了兼容以前的验证规则
            if (md5($password . $this->password_salt) != $this->password) {
                return false;
            }
        }

        return true;
    }

}
