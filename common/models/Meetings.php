<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meetings".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property int|null $teacher_id
 * @property int|null $amount
 * @property int|null $discount
 * @property int|null $disabled
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $creator
 * @property MeetingTimes[] $meetingTimes
 * @property ReserveMeetings[] $reserveMeetings
 * @property Sales[] $sales
 * @property User $teacher
 */
class Meetings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meetings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'teacher_id', 'amount', 'discount', 'disabled'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['teacher_id' => 'id']],
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
            'teacher_id' => 'Teacher ID',
            'amount' => 'Amount',
            'discount' => 'Discount',
            'disabled' => 'Disabled',
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
     * Gets query for [[MeetingTimes]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\MeetingTimesQuery
     */
    public function getMeetingTimes()
    {
        return $this->hasMany(MeetingTimes::class, ['meeting_id' => 'id']);
    }

    /**
     * Gets query for [[ReserveMeetings]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ReserveMeetingsQuery
     */
    public function getReserveMeetings()
    {
        return $this->hasMany(ReserveMeetings::class, ['meeting_id' => 'id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SalesQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::class, ['meeting_id' => 'id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::class, ['id' => 'teacher_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\MeetingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MeetingsQuery(get_called_class());
    }
}
