<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comments_reports".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $blog_id
 * @property int|null $webinar_id
 * @property int|null $comment_id
 * @property string|null $message
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Comments $comment
 */
class CommentsReports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments_reports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'blog_id', 'webinar_id', 'comment_id'], 'integer'],
            [['message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comments::class, 'targetAttribute' => ['comment_id' => 'id']],
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
            'blog_id' => 'Blog ID',
            'webinar_id' => 'Webinar ID',
            'comment_id' => 'Comment ID',
            'message' => 'Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Comment]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentsQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comments::class, ['id' => 'comment_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CommentsReportsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CommentsReportsQuery(get_called_class());
    }
}
