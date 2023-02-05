<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $webinar_id
 * @property string|null $title
 * @property string|null $accessibility
 * @property int|null $downloadable
 * @property string|null $storage
 * @property string|null $file
 * @property string|null $volume
 * @property string|null $file_type
 * @property string|null $description
 * @property int|null $order
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CourseLearning[] $courseLearnings
 * @property User $creator
 * @property TextLessonsAttachments[] $textLessonsAttachments
 * @property Webinars $webinar
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'webinar_id', 'downloadable', 'order'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'accessibility', 'storage', 'file', 'volume', 'file_type'], 'string', 'max' => 255],
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
            'accessibility' => 'Accessibility',
            'downloadable' => 'Downloadable',
            'storage' => 'Storage',
            'file' => 'File',
            'volume' => 'Volume',
            'file_type' => 'File Type',
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
        return $this->hasMany(CourseLearning::class, ['file_id' => 'id']);
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
        return $this->hasMany(TextLessonsAttachments::class, ['file_id' => 'id']);
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
     * @return \common\models\query\FilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FilesQuery(get_called_class());
    }
}
