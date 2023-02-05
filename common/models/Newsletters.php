<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "newsletters".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $email
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Newsletters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'newsletters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['email'], 'string', 'max' => 255],
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
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\NewslettersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\NewslettersQuery(get_called_class());
    }
}
