<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "supports".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $webinar_id
 * @property int|null $department_id
 * @property string|null $title
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property SupportDepartments $department
 * @property SupportConversations[] $supportConversations
 * @property User $user
 * @property Webinars $webinar
 */
class Supports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'webinar_id', 'department_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'status'], 'string', 'max' => 255],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupportDepartments::class, 'targetAttribute' => ['department_id' => 'id']],
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
            'webinar_id' => 'Webinar ID',
            'department_id' => 'Department ID',
            'title' => 'Title',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SupportDepartmentsQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(SupportDepartments::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[SupportConversations]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SupportConversationsQuery
     */
    public function getSupportConversations()
    {
        return $this->hasMany(SupportConversations::class, ['support_id' => 'id']);
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
     * @return \common\models\query\SupportsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SupportsQuery(get_called_class());
    }
}
