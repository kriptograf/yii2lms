<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $webinar_id
 * @property string|null $title
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int|null $discount
 * @property int|null $capacity
 * @property int|null $order
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Cart[] $carts
 * @property User $creator
 * @property OrderItems[] $orderItems
 * @property Sales[] $sales
 * @property TicketUsers[] $ticketUsers
 * @property Webinars $webinar
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'webinar_id', 'discount', 'capacity', 'order'], 'integer'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
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
            'creator_id' => 'Creator ID',
            'webinar_id' => 'Webinar ID',
            'title' => 'Title',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'discount' => 'Discount',
            'capacity' => 'Capacity',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CartQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['ticket_id' => 'id']);
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
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderItemsQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::class, ['ticket_id' => 'id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SalesQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::class, ['ticket_id' => 'id']);
    }

    /**
     * Gets query for [[TicketUsers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\TicketUsersQuery
     */
    public function getTicketUsers()
    {
        return $this->hasMany(TicketUsers::class, ['ticket_id' => 'id']);
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
     * @return \common\models\query\TicketsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TicketsQuery(get_called_class());
    }
}
