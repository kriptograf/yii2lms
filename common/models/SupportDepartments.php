<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "support_departments".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property Supports[] $supports
 */
class SupportDepartments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support_departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * Gets query for [[Supports]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\SupportsQuery
     */
    public function getSupports()
    {
        return $this->hasMany(Supports::class, ['department_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SupportDepartmentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SupportDepartmentsQuery(get_called_class());
    }
}
