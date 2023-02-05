<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Permissions]].
 *
 * @see \common\models\Permissions
 */
class PermissionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Permissions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Permissions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
