<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_channels".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $class_name
 * @property string|null $status
 * @property string|null $image
 * @property string|null $settings
 */
class PaymentChannels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_channels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['settings'], 'string'],
            [['title', 'class_name', 'status', 'image'], 'string', 'max' => 255],
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
            'class_name' => 'Class Name',
            'status' => 'Status',
            'image' => 'Image',
            'settings' => 'Settings',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PaymentChannelsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PaymentChannelsQuery(get_called_class());
    }
}
