<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sales_log".
 *
 * @property int $id
 * @property int|null $sale_id
 * @property string|null $viewed_at
 *
 * @property Sales $sale
 */
class SalesLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id'], 'integer'],
            [['viewed_at'], 'safe'],
            [['sale_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::class, 'targetAttribute' => ['sale_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_id' => 'Sale ID',
            'viewed_at' => 'Viewed At',
        ];
    }

    /**
     * Gets query for [[Sale]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SalesQuery
     */
    public function getSale()
    {
        return $this->hasOne(Sales::class, ['id' => 'sale_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SalesLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SalesLogQuery(get_called_class());
    }
}
