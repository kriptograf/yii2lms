<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notifications_status".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $notification_id
 * @property int|null $seen_at
 *
 * @property Notifications $notification
 * @property User $user
 */
class NotificationsStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'notification_id', 'seen_at'], 'integer'],
            [['notification_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notifications::class, 'targetAttribute' => ['notification_id' => 'id']],
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
            'notification_id' => 'Notification ID',
            'seen_at' => 'Seen At',
        ];
    }

    /**
     * Gets query for [[Notification]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\NotificationsQuery
     */
    public function getNotification()
    {
        return $this->hasOne(Notifications::class, ['id' => 'notification_id']);
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
     * @return \common\models\query\notQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\notQuery(get_called_class());
    }
}
