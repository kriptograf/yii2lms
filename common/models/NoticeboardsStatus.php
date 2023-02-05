<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "noticeboards_status".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $noticeboard_id
 * @property int|null $seen_at
 *
 * @property Noticeboards $noticeboard
 * @property User $user
 */
class NoticeboardsStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticeboards_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'noticeboard_id', 'seen_at'], 'integer'],
            [['noticeboard_id'], 'exist', 'skipOnError' => true, 'targetClass' => Noticeboards::class, 'targetAttribute' => ['noticeboard_id' => 'id']],
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
            'noticeboard_id' => 'Noticeboard ID',
            'seen_at' => 'Seen At',
        ];
    }

    /**
     * Gets query for [[Noticeboard]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\NoticeboardsQuery
     */
    public function getNoticeboard()
    {
        return $this->hasOne(Noticeboards::class, ['id' => 'noticeboard_id']);
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
     * @return \common\models\query\NoticeboardsStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\NoticeboardsStatusQuery(get_called_class());
    }
}
