<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meeting_times".
 *
 * @property int $id
 * @property int|null $meeting_id
 * @property string|null $day_label
 * @property string|null $time
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Accounting[] $accountings
 * @property Meetings $meeting
 * @property ReserveMeetings[] $reserveMeetings
 */
class MeetingTimes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meeting_times';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meeting_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['day_label', 'time'], 'string', 'max' => 255],
            [['meeting_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meetings::class, 'targetAttribute' => ['meeting_id' => 'id']],
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
            'day_label' => 'Day Label',
            'time' => 'Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Accountings]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\AccountingQuery
     */
    public function getAccountings()
    {
        return $this->hasMany(Accounting::class, ['meeting_time_id' => 'id']);
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
     * Gets query for [[ReserveMeetings]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ReserveMeetingsQuery
     */
    public function getReserveMeetings()
    {
        return $this->hasMany(ReserveMeetings::class, ['meeting_time_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MeetingTimesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MeetingTimesQuery(get_called_class());
    }
}
