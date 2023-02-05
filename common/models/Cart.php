<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $webinar_id
 * @property int|null $reserve_meeting_id
 * @property int|null $subscribe_id
 * @property int|null $promotion_id
 * @property int|null $ticket_id
 * @property int|null $special_offer_id
 *
 * @property User $creator
 * @property ReserveMeetings $reserveMeeting
 * @property Tickets $ticket
 * @property Webinars $webinar
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'webinar_id', 'reserve_meeting_id', 'subscribe_id', 'promotion_id', 'ticket_id', 'special_offer_id'], 'integer'],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['reserve_meeting_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveMeetings::class, 'targetAttribute' => ['reserve_meeting_id' => 'id']],
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
            'creator_id' => 'Creator ID',
            'webinar_id' => 'Webinar ID',
            'reserve_meeting_id' => 'Reserve Meeting ID',
            'subscribe_id' => 'Subscribe ID',
            'promotion_id' => 'Promotion ID',
            'ticket_id' => 'Ticket ID',
            'special_offer_id' => 'Special Offer ID',
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
     * @return \common\models\query\CartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CartQuery(get_called_class());
    }
}
