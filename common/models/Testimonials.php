<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "testimonials".
 *
 * @property int $id
 * @property string|null $user_name
 * @property string|null $user_avatar
 * @property string|null $user_bio
 * @property int|null $rate
 * @property string|null $comment
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Testimonials extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLE = 'disable';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testimonials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rate'], 'integer'],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_name', 'user_avatar', 'user_bio', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'user_avatar' => 'User Avatar',
            'user_bio' => 'User Bio',
            'rate' => 'Rate',
            'comment' => 'Comment',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TestimonialsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TestimonialsQuery(get_called_class());
    }
}
