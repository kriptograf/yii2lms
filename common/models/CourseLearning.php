<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course_learning".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $text_lesson_id
 * @property int|null $file_id
 * @property int|null $session_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Files $file
 * @property Sessions $session
 * @property TextLessons $textLesson
 * @property User $user
 */
class CourseLearning extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_learning';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'text_lesson_id', 'file_id', 'session_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::class, 'targetAttribute' => ['file_id' => 'id']],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sessions::class, 'targetAttribute' => ['session_id' => 'id']],
            [['text_lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => TextLessons::class, 'targetAttribute' => ['text_lesson_id' => 'id']],
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
            'text_lesson_id' => 'Text Lesson ID',
            'file_id' => 'File ID',
            'session_id' => 'Session ID',
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
     * Gets query for [[Session]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SessionsQuery
     */
    public function getSession()
    {
        return $this->hasOne(Sessions::class, ['id' => 'session_id']);
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
     * @return \common\models\query\CourseLearningQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CourseLearningQuery(get_called_class());
    }
}
