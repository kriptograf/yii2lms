<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payouts".
 *
 * @property int $id
 * @property int|null $user_id
 * @property float|null $amount
 * @property string|null $account_name
 * @property string|null $account_number
 * @property string|null $account_bank_name
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $user
 */
class Payouts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payouts';
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
            [['account_name', 'account_number', 'account_bank_name', 'status'], 'string', 'max' => 255],
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
            'account_name' => 'Account Name',
            'account_number' => 'Account Number',
            'account_bank_name' => 'Account Bank Name',
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
     * @return \common\models\query\PayoutsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PayoutsQuery(get_called_class());
    }
}
