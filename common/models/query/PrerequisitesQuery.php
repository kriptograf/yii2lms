<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Prerequisites]].
 *
 * @see \common\models\Prerequisites
 */
class PrerequisitesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Prerequisites[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Prerequisites|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
