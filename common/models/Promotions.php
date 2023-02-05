<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promotions".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $days
 * @property int|null $price
 * @property string|null $icon
 * @property int|null $is_popular
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Promotions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promotions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['days', 'price', 'is_popular'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'icon'], 'string', 'max' => 255],
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
            'days' => 'Days',
            'price' => 'Price',
            'icon' => 'Icon',
            'is_popular' => 'Is Popular',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PromotionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PromotionsQuery(get_called_class());
    }
}
