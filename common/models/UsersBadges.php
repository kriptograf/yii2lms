<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_badges".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $badge_id
 * @property string|null $created_at
 *
 * @property Badges $badge
 * @property User $user
 */
class UsersBadges extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_badges';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'badge_id'], 'integer'],
            [['created_at'], 'safe'],
            [['badge_id'], 'exist', 'skipOnError' => true, 'targetClass' => Badges::class, 'targetAttribute' => ['badge_id' => 'id']],
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
            'badge_id' => 'Badge ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Badge]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\BadgesQuery
     */
    public function getBadge()
    {
        return $this->hasOne(Badges::class, ['id' => 'badge_id']);
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
     * @return \common\models\query\UsersBadgesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UsersBadgesQuery(get_called_class());
    }
}
