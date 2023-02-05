<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quizzes_questions".
 *
 * @property int $id
 * @property int|null $quiz_id
 * @property int|null $creator_id
 * @property string|null $title
 * @property string|null $grade
 * @property string|null $type
 * @property string|null $correct
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $creator
 * @property Quizzes $quiz
 * @property QuizzesQuestionsAnswers[] $quizzesQuestionsAnswers
 */
class QuizzesQuestions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quizzes_questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quiz_id', 'creator_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'grade', 'type', 'correct'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quizzes::class, 'targetAttribute' => ['quiz_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quiz_id' => 'Quiz ID',
            'creator_id' => 'Creator ID',
            'title' => 'Title',
            'grade' => 'Grade',
            'type' => 'Type',
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
     * Gets query for [[Quiz]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\QuizzesQuery
     */
    public function getQuiz()
    {
        return $this->hasOne(Quizzes::class, ['id' => 'quiz_id']);
    }

    /**
     * Gets query for [[QuizzesQuestionsAnswers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\QuizzesQuestionsAnswersQuery
     */
    public function getQuizzesQuestionsAnswers()
    {
        return $this->hasMany(QuizzesQuestionsAnswers::class, ['question_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\QuizzesQuestionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\QuizzesQuestionsQuery(get_called_class());
    }
}
