<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quizzes".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $webinar_id
 * @property string|null $title
 * @property int|null $time
 * @property int|null $attempt
 * @property int|null $pass_mark
 * @property int|null $certificate
 * @property string|null $webinar_title
 * @property int|null $total_mark
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Certificates[] $certificates
 * @property User $creator
 * @property QuizzesQuestions[] $quizzesQuestions
 * @property QuizzesResults[] $quizzesResults
 * @property Webinars $webinar
 */
class Quizzes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quizzes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'webinar_id', 'time', 'attempt', 'pass_mark', 'certificate', 'total_mark'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'webinar_title', 'status'], 'string', 'max' => 255],
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
            'time' => 'Time',
            'attempt' => 'Attempt',
            'pass_mark' => 'Pass Mark',
            'certificate' => 'Certificate',
            'webinar_title' => 'Webinar Title',
            'total_mark' => 'Total Mark',
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
        return $this->hasMany(Certificates::class, ['quiz_id' => 'id']);
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
     * Gets query for [[QuizzesQuestions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\QuizzesQuestionsQuery
     */
    public function getQuizzesQuestions()
    {
        return $this->hasMany(QuizzesQuestions::class, ['quiz_id' => 'id']);
    }

    /**
     * Gets query for [[QuizzesResults]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\QuizzesResultsQuery
     */
    public function getQuizzesResults()
    {
        return $this->hasMany(QuizzesResults::class, ['quiz_id' => 'id']);
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
     * @return \common\models\query\QuizzesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\QuizzesQuery(get_called_class());
    }
}
