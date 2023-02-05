<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscribe_uses".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $subscribe_id
 * @property int|null $webinar_id
 * @property int|null $sale_id
 *
 * @property Sales $sale
 * @property Subscribes $subscribe
 * @property User $user
 * @property Webinars $webinar
 */
class SubscribeUses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscribe_uses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'subscribe_id', 'webinar_id', 'sale_id'], 'integer'],
            [['sale_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::class, 'targetAttribute' => ['sale_id' => 'id']],
            [['subscribe_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subscribes::class, 'targetAttribute' => ['subscribe_id' => 'id']],
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
            'subscribe_id' => 'Subscribe ID',
            'webinar_id' => 'Webinar ID',
            'sale_id' => 'Sale ID',
        ];
    }

    /**
     * Gets query for [[Sale]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SalesQuery
     */
    public function getSale()
    {
        return $this->hasOne(Sales::class, ['id' => 'sale_id']);
    }

    /**
     * Gets query for [[Subscribe]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SubscribesQuery
     */
    public function getSubscribe()
    {
        return $this->hasOne(Subscribes::class, ['id' => 'subscribe_id']);
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
     * @return \common\models\query\SubscribeUsesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SubscribeUsesQuery(get_called_class());
    }
}
