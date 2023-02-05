<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accounting".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $creator_id
 * @property int|null $webinar_id
 * @property int|null $meeting_time_id
 * @property int|null $subscribe_id
 * @property int|null $promotion_id
 * @property int|null $registration_package_id
 * @property int|null $system
 * @property int|null $tax
 * @property float|null $amount
 * @property string|null $type
 * @property string|null $type_account
 * @property string|null $store_type
 * @property int|null $referred_user_id
 * @property int|null $is_affiliate_amount
 * @property int|null $is_affiliate_commission
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property MeetingTimes $meetingTime
 * @property User $user
 * @property Webinars $webinar
 */
class Accounting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accounting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'creator_id', 'webinar_id', 'meeting_time_id', 'subscribe_id', 'promotion_id', 'registration_package_id', 'system', 'tax', 'referred_user_id', 'is_affiliate_amount', 'is_affiliate_commission'], 'integer'],
            [['amount'], 'number'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'type_account', 'store_type'], 'string', 'max' => 255],
            [['meeting_time_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeetingTimes::class, 'targetAttribute' => ['meeting_time_id' => 'id']],
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
            'creator_id' => 'Creator ID',
            'webinar_id' => 'Webinar ID',
            'meeting_time_id' => 'Meeting Time ID',
            'subscribe_id' => 'Subscribe ID',
            'promotion_id' => 'Promotion ID',
            'registration_package_id' => 'Registration Package ID',
            'system' => 'System',
            'tax' => 'Tax',
            'amount' => 'Amount',
            'type' => 'Type',
            'type_account' => 'Type Account',
            'store_type' => 'Store Type',
            'referred_user_id' => 'Referred User ID',
            'is_affiliate_amount' => 'Is Affiliate Amount',
            'is_affiliate_commission' => 'Is Affiliate Commission',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * @return \common\models\query\AccountingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AccountingQuery(get_called_class());
    }
}
