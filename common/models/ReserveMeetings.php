<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reserve_meetings".
 *
 * @property int $id
 * @property int|null $meeting_id
 * @property int|null $sale_id
 * @property int|null $meeting_time_id
 * @property int|null $user_id
 * @property string|null $day
 * @property string|null $date
 * @property string|null $locked_at
 * @property string|null $reserved_at
 * @property float|null $paid_amount
 * @property int|null $discount
 * @property string|null $link
 * @property string|null $password
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Cart[] $carts
 * @property Meetings $meeting
 * @property MeetingTimes $meetingTime
 * @property OrderItems[] $orderItems
 * @property User $user
 */
class ReserveMeetings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserve_meetings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meeting_id', 'sale_id', 'meeting_time_id', 'user_id', 'discount'], 'integer'],
            [['date', 'locked_at', 'reserved_at', 'created_at', 'updated_at'], 'safe'],
            [['paid_amount'], 'number'],
            [['day', 'link', 'password', 'status'], 'string', 'max' => 255],
            [['meeting_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meetings::class, 'targetAttribute' => ['meeting_id' => 'id']],
            [['meeting_time_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeetingTimes::class, 'targetAttribute' => ['meeting_time_id' => 'id']],
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
            'meeting_id' => 'Meeting ID',
            'sale_id' => 'Sale ID',
            'meeting_time_id' => 'Meeting Time ID',
            'user_id' => 'User ID',
            'day' => 'Day',
            'date' => 'Date',
            'locked_at' => 'Locked At',
            'reserved_at' => 'Reserved At',
            'paid_amount' => 'Paid Amount',
            'discount' => 'Discount',
            'link' => 'Link',
            'password' => 'Password',
            'status' => 'Status',
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
        return $this->hasMany(Cart::class, ['reserve_meeting_id' => 'id']);
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
     * Gets query for [[MeetingTime]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MeetingTimesQuery
     */
    public function getMeetingTime()
    {
        return $this->hasOne(MeetingTimes::class, ['id' => 'meeting_time_id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderItemsQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::class, ['reserve_meeting_id' => 'id']);
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
     * @return \common\models\query\ReserveMeetingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ReserveMeetingsQuery(get_called_class());
    }
}
