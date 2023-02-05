<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "discounts".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property string|null $title
 * @property string|null $code
 * @property int|null $percent
 * @property int|null $amount
 * @property int|null $count
 * @property string|null $type
 * @property string|null $expired_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $creator
 * @property DiscountUsers[] $discountUsers
 */
class Discounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'percent', 'amount', 'count'], 'integer'],
            [['expired_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'code', 'type'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
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
            'title' => 'Title',
            'code' => 'Code',
            'percent' => 'Percent',
            'amount' => 'Amount',
            'count' => 'Count',
            'type' => 'Type',
            'expired_at' => 'Expired At',
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
     * Gets query for [[DiscountUsers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\DiscountUsersQuery
     */
    public function getDiscountUsers()
    {
        return $this->hasMany(DiscountUsers::class, ['discount_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\DiscountsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DiscountsQuery(get_called_class());
    }
}
