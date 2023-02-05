<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "webinar_filter_option".
 *
 * @property int $id
 * @property int|null $webinar_id
 * @property int|null $filter_option_id
 *
 * @property FilterOptions $filterOption
 * @property Webinars $webinar
 */
class WebinarFilterOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'webinar_filter_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['webinar_id', 'filter_option_id'], 'integer'],
            [['filter_option_id'], 'exist', 'skipOnError' => true, 'targetClass' => FilterOptions::class, 'targetAttribute' => ['filter_option_id' => 'id']],
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
            'filter_option_id' => 'Filter Option ID',
        ];
    }

    /**
     * Gets query for [[FilterOption]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FilterOptionsQuery
     */
    public function getFilterOption()
    {
        return $this->hasOne(FilterOptions::class, ['id' => 'filter_option_id']);
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
     * @return \common\models\query\WebinarFilterOptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\WebinarFilterOptionQuery(get_called_class());
    }
}
