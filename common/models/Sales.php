<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sales".
 *
 * @property int $id
 * @property int|null $seller_id
 * @property int|null $buyer_id
 * @property int|null $order_id
 * @property int|null $webinar_id
 * @property int|null $meeting_id
 * @property int|null $subscribe_id
 * @property int|null $ticket_id
 * @property int|null $promotion_id
 * @property string|null $type
 * @property string|null $payment_method
 * @property int|null $amount
 * @property float|null $tax
 * @property float|null $commission
 * @property float|null $discount
 * @property float|null $total_amount
 * @property string|null $refund_at
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $buyer
 * @property Meetings $meeting
 * @property Orders $order
 * @property SalesLog[] $salesLogs
 * @property User $seller
 * @property SubscribeUses[] $subscribeUses
 * @property Tickets $ticket
 * @property Webinars $webinar
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seller_id', 'buyer_id', 'order_id', 'webinar_id', 'meeting_id', 'subscribe_id', 'ticket_id', 'promotion_id', 'amount'], 'integer'],
            [['tax', 'commission', 'discount', 'total_amount'], 'number'],
            [['refund_at', 'created_at', 'updated_at'], 'safe'],
            [['type', 'payment_method'], 'string', 'max' => 255],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['buyer_id' => 'id']],
            [['meeting_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meetings::class, 'targetAttribute' => ['meeting_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::class, 'targetAttribute' => ['order_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['seller_id' => 'id']],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tickets::class, 'targetAttribute' => ['ticket_id' => 'id']],
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
            'seller_id' => 'Seller ID',
            'buyer_id' => 'Buyer ID',
            'order_id' => 'Order ID',
            'webinar_id' => 'Webinar ID',
            'meeting_id' => 'Meeting ID',
            'subscribe_id' => 'Subscribe ID',
            'ticket_id' => 'Ticket ID',
            'promotion_id' => 'Promotion ID',
            'type' => 'Type',
            'payment_method' => 'Payment Method',
            'amount' => 'Amount',
            'tax' => 'Tax',
            'commission' => 'Commission',
            'discount' => 'Discount',
            'total_amount' => 'Total Amount',
            'refund_at' => 'Refund At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Buyer]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getBuyer()
    {
        return $this->hasOne(User::class, ['id' => 'buyer_id']);
    }

    /**
     * Gets query for [[Meeting]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MeetingsQuery
     */
    public function getMeeting()
    {
        return $this->hasOne(Meetings::class, ['id' => 'meeting_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrdersQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::class, ['id' => 'order_id']);
    }

    /**
     * Gets query for [[SalesLogs]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SalesLogQuery
     */
    public function getSalesLogs()
    {
        return $this->hasMany(SalesLog::class, ['sale_id' => 'id']);
    }

    /**
     * Gets query for [[Seller]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getSeller()
    {
        return $this->hasOne(User::class, ['id' => 'seller_id']);
    }

    /**
     * Gets query for [[SubscribeUses]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SubscribeUsesQuery
     */
    public function getSubscribeUses()
    {
        return $this->hasMany(SubscribeUses::class, ['sale_id' => 'id']);
    }

    /**
     * Gets query for [[Ticket]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TicketsQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Tickets::class, ['id' => 'ticket_id']);
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
     * @return \common\models\query\SalesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SalesQuery(get_called_class());
    }
}
