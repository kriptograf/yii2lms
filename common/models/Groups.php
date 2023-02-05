<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $id
 * @property int|null $creator_id
 * @property string|null $name
 * @property int|null $discount
 * @property int|null $commission
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property User $creator
 * @property GroupUsers[] $groupUsers
 * @property Notifications[] $notifications
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'discount', 'commission'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'status'], 'string', 'max' => 255],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'id']],
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
            'name' => 'Name',
            'discount' => 'Discount',
            'commission' => 'Commission',
            'status' => 'Status',
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
     * Gets query for [[GroupUsers]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\GroupUsersQuery
     */
    public function getGroupUsers()
    {
        return $this->hasMany(GroupUsers::class, ['group_id' => 'id']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\NotificationsQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notifications::class, ['group_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\GroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\GroupsQuery(get_called_class());
    }
}
