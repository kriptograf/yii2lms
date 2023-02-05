<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "webinar_reviews".
 *
 * @property int $id
 * @property int|null $webinar_id
 * @property int|null $creator_id
 * @property int|null $content_quality
 * @property int|null $instructor_skills
 * @property int|null $purchase_worth
 * @property int|null $support_quality
 * @property int|null $rates
 * @property string|null $description
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $creator
 * @property Webinars $webinar
 */
class WebinarReviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'webinar_reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['webinar_id', 'creator_id', 'content_quality', 'instructor_skills', 'purchase_worth', 'support_quality', 'rates'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'string', 'max' => 255],
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
            'webinar_id' => 'Webinar ID',
            'creator_id' => 'Creator ID',
            'content_quality' => 'Content Quality',
            'instructor_skills' => 'Instructor Skills',
            'purchase_worth' => 'Purchase Worth',
            'support_quality' => 'Support Quality',
            'rates' => 'Rates',
            'description' => 'Description',
            'status' => 'Status',
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
     * @return \common\models\query\WebinarReviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WebinarReviewsQuery(get_called_class());
    }
}
