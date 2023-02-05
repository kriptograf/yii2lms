<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $webinar_id
 *
 * @property Webinars $webinar
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['webinar_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'webinar_id' => 'Webinar ID',
        ];
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
     * @return \common\models\query\TagsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TagsQuery(get_called_class());
    }
}
