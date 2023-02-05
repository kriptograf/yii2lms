<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "text_lessons".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $webinar_id
 * @property string|null $title
 * @property string|null $image
 * @property int|null $study_time
 * @property string|null $summary
 * @property string|null $content
 * @property string|null $accessibility
 * @property int|null $order
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CourseLearning[] $courseLearnings
 * @property User $creator
 * @property TextLessonsAttachments[] $textLessonsAttachments
 * @property Webinars $webinar
 */
class TextLessons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'text_lessons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'webinar_id', 'study_time', 'order'], 'integer'],
            [['summary', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'image', 'accessibility'], 'string', 'max' => 255],
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
            'image' => 'Image',
            'study_time' => 'Study Time',
            'summary' => 'Summary',
            'content' => 'Content',
            'accessibility' => 'Accessibility',
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
        return $this->hasMany(CourseLearning::class, ['text_lesson_id' => 'id']);
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
     * Gets query for [[TextLessonsAttachments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TextLessonsAttachmentsQuery
     */
    public function getTextLessonsAttachments()
    {
        return $this->hasMany(TextLessonsAttachments::class, ['text_lesson_id' => 'id']);
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
     * @return \common\models\query\TextLessonsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TextLessonsQuery(get_called_class());
    }
}
