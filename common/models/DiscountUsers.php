<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "discount_users".
 *
 * @property int $id
 * @property int|null $discount_id
 * @property int|null $user_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Discounts $discount
 * @property User $user
 */
class DiscountUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'discount_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discount_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['discount_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discounts::class, 'targetAttribute' => ['discount_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'discount_id' => 'Discount ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Discount]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\DiscountsQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discounts::class, ['id' => 'discount_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\DiscountUsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DiscountUsersQuery(get_called_class());
    }
}
