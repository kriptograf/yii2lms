<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "badges".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $type
 * @property string|null $condition
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property UsersBadges[] $usersBadges
 */
class Badges extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'badges';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'image', 'type', 'condition'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'type' => 'Type',
            'condition' => 'Condition',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[UsersBadges]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UsersBadgesQuery
     */
    public function getUsersBadges()
    {
        return $this->hasMany(UsersBadges::class, ['badge_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\BadgesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BadgesQuery(get_called_class());
    }
}
