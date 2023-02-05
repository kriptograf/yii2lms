<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "offline_payments".
 *
 * @property int $id
 * @property int|null $user_id
 * @property float|null $amount
 * @property string|null $bank
 * @property string|null $reference_number
 * @property string|null $pay_date
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $user
 */
class OfflinePayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offline_payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['bank', 'reference_number', 'pay_date', 'status'], 'string', 'max' => 255],
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
            'amount' => 'Amount',
            'bank' => 'Bank',
            'reference_number' => 'Reference Number',
            'pay_date' => 'Pay Date',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * @return \common\models\query\OfflinePaymentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OfflinePaymentsQuery(get_called_class());
    }
}
