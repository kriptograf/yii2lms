<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification_templates".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $template
 */
class NotificationTemplates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['template'], 'string'],
            [['title'], 'string', 'max' => 255],
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
            'template' => 'Template',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\NotificationTemplatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\NotificationTemplatesQuery(get_called_class());
    }
}
