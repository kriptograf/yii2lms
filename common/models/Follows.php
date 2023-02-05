<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "follows".
 *
 * @property int $id
 * @property int|null $follower
 * @property int|null $user_id
 * @property string|null $status
 *
 * @property User $follower0
 * @property User $user
 */
class Follows extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'follows';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['follower', 'user_id'], 'integer'],
            [['status'], 'string', 'max' => 255],
            [['follower'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['follower' => 'id']],
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
            'follower' => 'Follower',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Follower0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getFollower0()
    {
        return $this->hasOne(User::class, ['id' => 'follower']);
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
     * @return \common\models\query\FollowsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FollowsQuery(get_called_class());
    }
}
