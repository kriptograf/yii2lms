<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feature_webinars".
 *
 * @property int $id
 * @property int|null $webinar_id
 * @property string|null $page
 * @property string|null $description
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Webinars $webinar
 */
class FeatureWebinars extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISH = 'publish';
    const STATUS_PENDING = 'pending';

    public static array $pages = ['categories', 'home', 'home_categories'];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feature_webinars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['webinar_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['page', 'status'], 'string', 'max' => 255],
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
            'page' => 'Page',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * @return \common\models\query\FeatureWebinarsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FeatureWebinarsQuery(get_called_class());
    }
}
