<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quizzes_results".
 *
 * @property int $id
 * @property int|null $quiz_id
 * @property int|null $user_id
 * @property string|null $results
 * @property int|null $user_grade
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Certificates[] $certificates
 * @property Quizzes $quiz
 * @property User $user
 */
class QuizzesResults extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quizzes_results';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quiz_id', 'user_id', 'user_grade'], 'integer'],
            [['results'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'string', 'max' => 255],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quizzes::class, 'targetAttribute' => ['quiz_id' => 'id']],
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
            'quiz_id' => 'Quiz ID',
            'user_id' => 'User ID',
            'results' => 'Results',
            'user_grade' => 'User Grade',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Certificates]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CertificatesQuery
     */
    public function getCertificates()
    {
        return $this->hasMany(Certificates::class, ['quiz_result_id' => 'id']);
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
     * @return \common\models\query\QuizzesResultsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\QuizzesResultsQuery(get_called_class());
    }
}
