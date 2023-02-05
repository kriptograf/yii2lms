<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faqs".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $webinar_id
 * @property string|null $title
 * @property string|null $answer
 * @property int|null $order
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $creator
 * @property Webinars $webinar
 */
class Faqs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faqs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'webinar_id', 'order'], 'integer'],
            [['answer'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
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
            'answer' => 'Answer',
            'order' => 'Order',
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
     * @return \common\models\query\FaqsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FaqsQuery(get_called_class());
    }
}
