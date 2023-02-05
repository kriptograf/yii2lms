<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "verifications".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $code
 * @property string|null $verified_at
 * @property string|null $expired_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $user
 */
class Verifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['verified_at', 'expired_at', 'created_at', 'updated_at'], 'safe'],
            [['mobile', 'email', 'code'], 'string', 'max' => 255],
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
            'mobile' => 'Mobile',
            'email' => 'Email',
            'code' => 'Code',
            'verified_at' => 'Verified At',
            'expired_at' => 'Expired At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VerificationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VerificationsQuery(get_called_class());
    }
}
