<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "filter_options".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $filter_id
 * @property int|null $order
 *
 * @property Filters $filter
 * @property WebinarFilterOption[] $webinarFilterOptions
 */
class FilterOptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'filter_options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filter_id', 'order'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['filter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Filters::class, 'targetAttribute' => ['filter_id' => 'id']],
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
            'filter_id' => 'Filter ID',
            'order' => 'Order',
        ];
    }

    /**
     * Gets query for [[Filter]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FiltersQuery
     */
    public function getFilter()
    {
        return $this->hasOne(Filters::class, ['id' => 'filter_id']);
    }

    /**
     * Gets query for [[WebinarFilterOptions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\WebinarFilterOptionQuery
     */
    public function getWebinarFilterOptions()
    {
        return $this->hasMany(WebinarFilterOption::class, ['filter_option_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\FilterOptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FilterOptionsQuery(get_called_class());
    }
}
