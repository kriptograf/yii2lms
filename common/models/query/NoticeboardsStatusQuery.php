<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\NoticeboardsStatus]].
 *
 * @see \common\models\NoticeboardsStatus
 */
class NoticeboardsStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\NoticeboardsStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\NoticeboardsStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
