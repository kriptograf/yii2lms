<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $webinar_id
 * @property int|null $blog_id
 * @property int|null $reply_id
 * @property int|null $review_id
 * @property string|null $comment
 * @property string|null $status
 * @property int|null $report
 * @property int|null $disabled
 * @property int|null $viewed_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CommentsReports[] $commentsReports
 * @property User $user
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'webinar_id', 'blog_id', 'reply_id', 'review_id', 'report', 'disabled', 'viewed_at'], 'integer'],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'string', 'max' => 255],
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
            'webinar_id' => 'Webinar ID',
            'blog_id' => 'Blog ID',
            'reply_id' => 'Reply ID',
            'review_id' => 'Review ID',
            'comment' => 'Comment',
            'status' => 'Status',
            'report' => 'Report',
            'disabled' => 'Disabled',
            'viewed_at' => 'Viewed At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CommentsReports]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentsReportsQuery
     */
    public function getCommentsReports()
    {
        return $this->hasMany(CommentsReports::class, ['comment_id' => 'id']);
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
     * @return \common\models\query\CommentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CommentsQuery(get_called_class());
    }
}
