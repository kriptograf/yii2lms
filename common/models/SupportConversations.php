<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "support_conversations".
 *
 * @property int $id
 * @property int|null $support_id
 * @property int|null $supporter_id
 * @property int|null $sender_id
 * @property string|null $attach
 * @property string|null $message
 * @property string|null $created_at
 *
 * @property User $sender
 * @property Supports $support
 * @property User $supporter
 */
class SupportConversations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support_conversations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['support_id', 'supporter_id', 'sender_id'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['attach'], 'string', 'max' => 255],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['sender_id' => 'id']],
            [['support_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supports::class, 'targetAttribute' => ['support_id' => 'id']],
            [['supporter_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['supporter_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'support_id' => 'Support ID',
            'supporter_id' => 'Supporter ID',
            'sender_id' => 'Sender ID',
            'attach' => 'Attach',
            'message' => 'Message',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Sender]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::class, ['id' => 'sender_id']);
    }

    /**
     * Gets query for [[Support]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SupportsQuery
     */
    public function getSupport()
    {
        return $this->hasOne(Supports::class, ['id' => 'support_id']);
    }

    /**
     * Gets query for [[Supporter]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getSupporter()
    {
        return $this->hasOne(User::class, ['id' => 'supporter_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SupportConversationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SupportConversationsQuery(get_called_class());
    }
}
