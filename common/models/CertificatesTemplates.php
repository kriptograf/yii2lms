<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "certificates_templates".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $body
 * @property string|null $image
 * @property string|null $position_x
 * @property string|null $position_y
 * @property string|null $font_size
 * @property string|null $text_color
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class CertificatesTemplates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'certificates_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'image', 'position_x', 'position_y', 'font_size', 'text_color', 'status'], 'string', 'max' => 255],
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
            'body' => 'Body',
            'image' => 'Image',
            'position_x' => 'Position X',
            'position_y' => 'Position Y',
            'font_size' => 'Font Size',
            'text_color' => 'Text Color',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CertificatesTemplatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CertificatesTemplatesQuery(get_called_class());
    }
}
