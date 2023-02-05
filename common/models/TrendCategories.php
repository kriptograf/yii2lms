<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "trend_categories".
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $icon
 * @property string|null $color
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Categories $category
 */
class TrendCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trend_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['icon', 'color'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'icon' => 'Icon',
            'color' => 'Color',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CategoriesQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TrendCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TrendCategoriesQuery(get_called_class());
    }
}
