<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quizzes_questions_answers".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $question_id
 * @property string|null $title
 * @property string|null $image
 * @property int|null $correct
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $creator
 * @property QuizzesQuestions $question
 */
class QuizzesQuestionsAnswers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quizzes_questions_answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'question_id', 'correct'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'image'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuizzesQuestions::class, 'targetAttribute' => ['question_id' => 'id']],
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
            'question_id' => 'Question ID',
            'title' => 'Title',
            'image' => 'Image',
            'correct' => 'Correct',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\QuizzesQuestionsQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(QuizzesQuestions::class, ['id' => 'question_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\QuizzesQuestionsAnswersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\QuizzesQuestionsAnswersQuery(get_called_class());
    }
}
