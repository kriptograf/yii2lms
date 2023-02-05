<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_metas".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $value
 */
class UsersMetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_metas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\UsersMetasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UsersMetasQuery(get_called_class());
    }
}
