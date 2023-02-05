<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prerequisites".
 *
 * @property int $id
 * @property int|null $webinar_id
 * @property int|null $prerequisite_id
 * @property int|null $required
 * @property int|null $order
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Webinars $webinar
 */
class Prerequisites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prerequisites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['webinar_id', 'prerequisite_id', 'required', 'order'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'webinar_id' => 'Webinar ID',
            'prerequisite_id' => 'Prerequisite ID',
            'required' => 'Required',
            'order' => 'Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * @return \common\models\query\PrerequisitesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PrerequisitesQuery(get_called_class());
    }
}
