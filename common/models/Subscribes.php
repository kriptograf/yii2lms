<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscribes".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $usable_count
 * @property int|null $days
 * @property int|null $price
 * @property string|null $icon
 * @property string|null $description
 * @property int|null $is_popular
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property SubscribeUses[] $subscribeUses
 */
class Subscribes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscribes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usable_count', 'days', 'price', 'is_popular'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'icon', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'usable_count' => 'Usable Count',
            'days' => 'Days',
            'price' => 'Price',
            'icon' => 'Icon',
            'description' => 'Description',
            'is_popular' => 'Is Popular',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[SubscribeUses]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SubscribeUsesQuery
     */
    public function getSubscribeUses()
    {
        return $this->hasMany(SubscribeUses::class, ['subscribe_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SubscribesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SubscribesQuery(get_called_class());
    }
}
