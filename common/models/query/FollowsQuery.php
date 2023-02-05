<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Follows]].
 *
 * @see \common\models\Follows
 */
class FollowsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Follows[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Follows|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
