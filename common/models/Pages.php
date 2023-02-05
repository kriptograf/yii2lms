<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string|null $link
 * @property string|null $name
 * @property string|null $title
 * @property string|null $seo_description
 * @property int|null $robot
 * @property string|null $content
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['robot'], 'integer'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['link', 'name', 'title', 'seo_description', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'name' => 'Name',
            'title' => 'Title',
            'seo_description' => 'Seo Description',
            'robot' => 'Robot',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PagesQuery(get_called_class());
    }
}
