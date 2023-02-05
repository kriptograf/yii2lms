<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payu_transactions".
 *
 * @property int $id
 * @property int|null $paid_for_id
 * @property string|null $paid_for_type
 * @property string|null $transaction_id
 * @property string|null $gateway
 * @property string|null $body
 * @property string|null $destination
 * @property string|null $hash
 * @property string|null $response
 * @property string|null $status
 * @property string|null $verified_at
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class PayuTransactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payu_transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paid_for_id'], 'integer'],
            [['gateway', 'body', 'hash'], 'string'],
            [['verified_at', 'created_at', 'updated_at'], 'safe'],
            [['paid_for_type', 'transaction_id', 'destination', 'response', 'status'], 'string', 'max' => 255],
            [['transaction_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'paid_for_id' => 'Paid For ID',
            'paid_for_type' => 'Paid For Type',
            'transaction_id' => 'Transaction ID',
            'gateway' => 'Gateway',
            'body' => 'Body',
            'destination' => 'Destination',
            'hash' => 'Hash',
            'response' => 'Response',
            'status' => 'Status',
            'verified_at' => 'Verified At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PayuTransactionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PayuTransactionsQuery(get_called_class());
    }
}
