<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "filters".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $category_id
 *
 * @property Categories $category
 * @property FilterOptions[] $filterOptions
 */
class Filters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'filters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'category_id' => 'Category ID',
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
     * Gets query for [[FilterOptions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FilterOptionsQuery
     */
    public function getFilterOptions()
    {
        return $this->hasMany(FilterOptions::class, ['filter_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\FiltersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FiltersQuery(get_called_class());
    }
}
