<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "noticeboards".
 *
 * @property int $id
 * @property int|null $organ_id
 * @property int|null $user_id
 * @property string|null $type
 * @property string|null $sender
 * @property string|null $title
 * @property string|null $message
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property NoticeboardsStatus[] $noticeboardsStatuses
 * @property User $organ
 * @property User $user
 */
class Noticeboards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticeboards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['organ_id', 'user_id'], 'integer'],
            [['message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'sender', 'title'], 'string', 'max' => 255],
            [['organ_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['organ_id' => 'id']],
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
            'organ_id' => 'Organ ID',
            'user_id' => 'User ID',
            'type' => 'Type',
            'sender' => 'Sender',
            'title' => 'Title',
            'message' => 'Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[NoticeboardsStatuses]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\NoticeboardsStatusQuery
     */
    public function getNoticeboardsStatuses()
    {
        return $this->hasMany(NoticeboardsStatus::class, ['noticeboard_id' => 'id']);
    }

    /**
     * Gets query for [[Organ]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getOrgan()
    {
        return $this->hasOne(User::class, ['id' => 'organ_id']);
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
     * @return \common\models\query\NoticeboardsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\NoticeboardsQuery(get_called_class());
    }
}
