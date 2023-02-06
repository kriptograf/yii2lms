<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "special_offers".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $webinar_id
 * @property string|null $name
 * @property int|null $percent
 * @property int|null $status
 * @property string|null $from_date
 * @property string|null $to_date
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $creator
 * @property Webinars $webinar
 */
class SpecialOffers extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = true;
    const STATUS_INACTIVE = false;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'special_offers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'webinar_id', 'percent', 'status'], 'integer'],
            [['from_date', 'to_date', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'percent' => 'Percent',
            'status' => 'Status',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
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
     * @return \common\models\query\SpecialOffersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SpecialOffersQuery(get_called_class());
    }
}
