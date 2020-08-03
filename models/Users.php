<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $resetKey
 * @property string $password
 * @property string $displayname
 * @property int $news-id
 * @property int $'cate-id
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'created_at', 'updated_at', 'resetKey', 'password', 'displayname', 'news-id', 'cate-id'], 'required'],
            [[ 'created_at', 'updated_at', 'news-id', 'cate-id'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'resetKey', 'password', 'displayname'], 'string', 'max' => 64],
            [['auth_key'], 'string', 'max' => 32],
            [['status'], 'default', 'value' => 'user'],
            [['access'], 'default', 'value' => 'user'],
            [['voices_ip'], 'default', 'value' => 0],
            [['ip'], 'default', 'value' => Yii::$app->request->userIP],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'resetKey' => 'Reset Key',
            'password' => 'Password',
            'displayname' => 'Displayname',
            'news-id' => 'News ID',
            'cate-id' => 'cate ID',
        ];
    }
}
