<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "certificates".
 *
 * @property int $id
 * @property int|null $quiz_id
 * @property int|null $quiz_result_id
 * @property int|null $student_id
 * @property int|null $user_grade
 * @property string|null $file
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Quizzes $quiz
 * @property QuizzesResults $quizResult
 * @property User $student
 */
class Certificates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'certificates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quiz_id', 'quiz_result_id', 'student_id', 'user_grade'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['file'], 'string', 'max' => 255],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quizzes::class, 'targetAttribute' => ['quiz_id' => 'id']],
            [['quiz_result_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuizzesResults::class, 'targetAttribute' => ['quiz_result_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['student_id' => 'id']],
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
            'quiz_result_id' => 'Quiz Result ID',
            'student_id' => 'Student ID',
            'user_grade' => 'User Grade',
            'file' => 'File',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * Gets query for [[QuizResult]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\QuizzesResultsQuery
     */
    public function getQuizResult()
    {
        return $this->hasOne(QuizzesResults::class, ['id' => 'quiz_result_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::class, ['id' => 'student_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CertificatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CertificatesQuery(get_called_class());
    }
}
