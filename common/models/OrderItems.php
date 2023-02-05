<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $order_id
 * @property int|null $webinar_id
 * @property int|null $subscribe_id
 * @property int|null $promotion_id
 * @property int|null $reserve_meeting_id
 * @property int|null $ticket_id
 * @property int|null $discount_id
 * @property int|null $amount
 * @property int|null $tax
 * @property float|null $tax_price
 * @property int|null $commission
 * @property float|null $commission_price
 * @property float|null $discount
 * @property float|null $total_amount
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Orders $order
 * @property ReserveMeetings $reserveMeeting
 * @property Tickets $ticket
 * @property User $user
 * @property Webinars $webinar
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'order_id', 'webinar_id', 'subscribe_id', 'promotion_id', 'reserve_meeting_id', 'ticket_id', 'discount_id', 'amount', 'tax', 'commission'], 'integer'],
            [['tax_price', 'commission_price', 'discount', 'total_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::class, 'targetAttribute' => ['order_id' => 'id']],
            [['reserve_meeting_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveMeetings::class, 'targetAttribute' => ['reserve_meeting_id' => 'id']],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tickets::class, 'targetAttribute' => ['ticket_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'order_id' => 'Order ID',
            'webinar_id' => 'Webinar ID',
            'subscribe_id' => 'Subscribe ID',
            'promotion_id' => 'Promotion ID',
            'reserve_meeting_id' => 'Reserve Meeting ID',
            'ticket_id' => 'Ticket ID',
            'discount_id' => 'Discount ID',
            'amount' => 'Amount',
            'tax' => 'Tax',
            'tax_price' => 'Tax Price',
            'commission' => 'Commission',
            'commission_price' => 'Commission Price',
            'discount' => 'Discount',
            'total_amount' => 'Total Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * Gets query for [[ReserveMeeting]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ReserveMeetingsQuery
     */
    public function getReserveMeeting()
    {
        return $this->hasOne(ReserveMeetings::class, ['id' => 'reserve_meeting_id']);
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
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
     * @return \common\models\query\OrderItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderItemsQuery(get_called_class());
    }
}
