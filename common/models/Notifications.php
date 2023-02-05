<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $group_id
 * @property string|null $title
 * @property string|null $message
 * @property string|null $sender
 * @property string|null $type
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Groups $group
 * @property NotificationsStatus[] $notificationsStatuses
 * @property User $user
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id'], 'integer'],
            [['message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'sender', 'type'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::class, 'targetAttribute' => ['group_id' => 'id']],
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
            'group_id' => 'Group ID',
            'title' => 'Title',
            'message' => 'Message',
            'sender' => 'Sender',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GroupsQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for [[NotificationsStatuses]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\NotificationsStatusQuery
     */
    public function getNotificationsStatuses()
    {
        return $this->hasMany(NotificationsStatus::class, ['notification_id' => 'id']);
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
     * @return \common\models\query\NotificationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\NotificationsQuery(get_called_class());
    }
}
