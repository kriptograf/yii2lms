<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $status
 * @property string|null $payment_method
 * @property int|null $is_charge_account
 * @property string|null $type
 * @property int|null $amount
 * @property float|null $tax
 * @property float|null $total_discount
 * @property float|null $total_amount
 * @property string|null $reference_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property OrderItems[] $orderItems
 * @property Sales[] $sales
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'is_charge_account', 'amount'], 'integer'],
            [['tax', 'total_discount', 'total_amount'], 'number'],
            [['reference_id'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'payment_method', 'type'], 'string', 'max' => 255],
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
            'user_id' => 'User ID',
            'status' => 'Status',
            'payment_method' => 'Payment Method',
            'is_charge_account' => 'Is Charge Account',
            'type' => 'Type',
            'amount' => 'Amount',
            'tax' => 'Tax',
            'total_discount' => 'Total Discount',
            'total_amount' => 'Total Amount',
            'reference_id' => 'Reference ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderItemsQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SalesQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::class, ['order_id' => 'id']);
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
     * @return \common\models\query\OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrdersQuery(get_called_class());
    }
}
