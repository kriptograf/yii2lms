<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sessions".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $webinar_id
 * @property string|null $title
 * @property string|null $date
 * @property int|null $duration
 * @property string|null $link
 * @property string|null $session_api
 * @property string|null $api_secret
 * @property string|null $moderator_secret
 * @property string|null $zoom_start_link
 * @property string|null $description
 * @property int|null $order
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CourseLearning[] $courseLearnings
 * @property User $creator
 * @property Webinars $webinar
 */
class Sessions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sessions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'webinar_id', 'duration', 'order'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['zoom_start_link', 'description'], 'string'],
            [['title', 'link', 'session_api', 'api_secret', 'moderator_secret'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['webinar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Webinars::class, 'targetAttribute' => ['webinar_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creator_id' => 'Creator ID',
            'webinar_id' => 'Webinar ID',
            'title' => 'Title',
            'date' => 'Date',
            'duration' => 'Duration',
            'link' => 'Link',
            'session_api' => 'Session Api',
            'api_secret' => 'Api Secret',
            'moderator_secret' => 'Moderator Secret',
            'zoom_start_link' => 'Zoom Start Link',
            'description' => 'Description',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[CourseLearnings]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CourseLearningQuery
     */
    public function getCourseLearnings()
    {
        return $this->hasMany(CourseLearning::class, ['session_id' => 'id']);
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['id' => 'creator_id']);
    }

    /**
     * Gets query for [[Webinar]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WebinarsQuery
     */
    public function getWebinar()
    {
        return $this->hasOne(Webinars::class, ['id' => 'webinar_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SessionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SessionsQuery(get_called_class());
    }
}
