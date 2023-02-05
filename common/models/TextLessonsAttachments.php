<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "text_lessons_attachments".
 *
 * @property int $id
 * @property int|null $text_lesson_id
 * @property int|null $file_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Files $file
 * @property TextLessons $textLesson
 */
class TextLessonsAttachments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'text_lessons_attachments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text_lesson_id', 'file_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::class, 'targetAttribute' => ['file_id' => 'id']],
            [['text_lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => TextLessons::class, 'targetAttribute' => ['text_lesson_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text_lesson_id' => 'Text Lesson ID',
            'file_id' => 'File ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FilesQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::class, ['id' => 'file_id']);
    }

    /**
     * Gets query for [[TextLesson]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TextLessonsQuery
     */
    public function getTextLesson()
    {
        return $this->hasOne(TextLessons::class, ['id' => 'text_lesson_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TextLessonsAttachmentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TextLessonsAttachmentsQuery(get_called_class());
    }
}
