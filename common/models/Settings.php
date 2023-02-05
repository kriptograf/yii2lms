<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string|null $page
 * @property string|null $name
 * @property string|null $value
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['page', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page' => 'Page',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SettingsQuery(get_called_class());
    }
}
