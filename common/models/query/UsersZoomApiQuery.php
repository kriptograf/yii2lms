<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\UsersZoomApi]].
 *
 * @see \common\models\UsersZoomApi
 */
class UsersZoomApiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\UsersZoomApi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\UsersZoomApi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
