<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sections".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $section_group_id
 * @property string|null $caption
 *
 * @property Permissions[] $permissions
 */
class Sections extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sections';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['section_group_id'], 'integer'],
            [['name', 'caption'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'section_group_id' => 'Section Group ID',
            'caption' => 'Caption',
        ];
    }

    /**
     * Gets query for [[Permissions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PermissionsQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(Permissions::class, ['section_id' => 'id']);
    }

    /**
     * Создает новую запись в таблице sections
     *
     * @param int $id
     * @param string $name
     * @param string $caption
     * @param int|null $section_group
     *
     * @return bool
     * @author Виталий Москвин <foreach@mail.ru>
     */
    public static function create(int $id, string $name, string $caption, int $section_group = null): bool
    {
        $model = new static();
        $model->id = $id;
        $model->name = $name;
        $model->section_group_id = $section_group;
        $model->caption = $caption;

        return $model->save();
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\SectionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SectionsQuery(get_called_class());
    }
}
